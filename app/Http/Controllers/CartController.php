<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Models\OrderProductSeller;
use Illuminate\Support\Facades\DB;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public function index($order_id)
    {

        if ($order_id == -1) {
            $openOrder = Order::where(['customer_id' => auth()->user()->profile->id, 'is_done' => false])
                ->with([
                    'order_product_sellers',
                    'order_product_sellers.product_seller',
                    'order_product_sellers.product_seller.product'
                ])
                // ->select('*', DB::raw('sum(product_seller.price * order_product_sellers.count) as total'))
                ->get()->first();

                if($openOrder==null){
                    $openOrder = Order::create([
                        'customer_id' => auth()->user()->profile->id
                    ]);
                }
        }
        else{
            $openOrder = Order::
                with([
                    'order_product_sellers',
                    'order_product_sellers.product_seller',
                    'order_product_sellers.product_seller.product'
                ])
                // ->select('*', DB::raw('sum(product_seller.price * order_product_sellers.count) as total'))
                ->find($order_id);
        }

        $sum = $openOrder->order_product_sellers->sum(function ($region) {
            return $region->count * $region->product_seller->price;
        });

        // dd($openOrder->product_seller->sum('price'));

        // $opss = OrderProductSeller::where('order_id', $openOrder->id)->with(['product_seller', 'product_seller.product'])->get();

        return view('order.cart', [
            'cart' => $openOrder,
            'sum' => $sum
        ]);
    }


    public function store()
    {
        $openOrder = Order::where(['customer_id' => auth()->user()->profile->id, 'is_done' => false])
            ->with([
                'order_product_sellers',
                'order_product_sellers.product_seller',
                'order_product_sellers.product_seller.product'
            ])
            ->get()[0];

        DB::beginTransaction();

        try {
            foreach ($openOrder->order_product_sellers as $ops) {
                ProductSeller::where('id', $ops->product_seller->id)->decrement('count', $ops->count);
            }

            Order::where('id', $openOrder->id)
                ->update(['is_done' => true, 'order_date' => now()]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->route('orders');
    }

    public function delete(Request $request)
    {
        $ops = OrderProductSeller::with('product_seller')->find($request['id']);
        // OrderProductSeller::where('id', $request['id'])->delete();
        $ops->product_seller->count += $ops->count;
        $ops->product_seller->save();
        $ops->delete();
        return redirect()->route('cart',['id'=>-1]);
    }

    public function update(Request $request)
    {
        $ops = OrderProductSeller::with('product_seller')->find($request->id);
        if ($request->value == 1) { // increment
            if ($ops->product_seller->count == 0)
                return Response::json(['error' => 'not enough products in seller shop'], 405);
            $ops->product_seller->count -= 1;
            $ops->count += 1;
        } else if ($ops->count > 1) {
            $ops->count -= 1;
            $ops->product_seller->count += 1;
        }
        $ops->save();
        $ops->product_seller->save();
        return $ops->count;
    }
}
