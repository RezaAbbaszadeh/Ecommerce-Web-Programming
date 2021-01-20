<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Models\OrderProductSeller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {

        $openOrder = Order::where(['customer_id' => auth()->user()->profile->id, 'is_done' => false])
            ->with([
                'order_product_sellers',
                'order_product_sellers.product_seller',
                'order_product_sellers.product_seller.product'
            ])
            // ->withSum('order_product_sellers.product_seller', 'price')
            ->get();

        // dd($openOrder->product_seller->sum('price'));

        // $opss = OrderProductSeller::where('order_id', $openOrder->id)->with(['product_seller', 'product_seller.product'])->get();

        return view('order.cart', [
            'cart' => $openOrder[0]
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
}
