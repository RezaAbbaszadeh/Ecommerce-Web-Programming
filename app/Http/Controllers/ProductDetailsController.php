<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProductSeller;
use App\Models\Product;
use App\Models\ProductSeller;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index(Product $product)
    {

        $p = ProductSeller::where('product_id', $product->id)->with('seller')->get();

        // dd($p[0]->seller->user->name);
        return view('product.details',[
            'product'=>$product,
            'ps'=> $p
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'count' => 'required|integer|min:1',
        ]);

        $openOrder = Order::where(['customer_id' => auth()->user()->profile->id, 'is_done'=> false])->get();
        // dd($openOrder);
        if(!$openOrder->count()){
            $openOrder = Order::create([
                'customer_id'=>auth()->user()->profile->id,
            ]);
            //$openOrder->save();
        }
        else{
            $openOrder = $openOrder[0];
        }

        $ops = OrderProductSeller::create([
            'order_id'=>$openOrder->id,
            'product_seller_id'=>$request->input('product_seller_id'),
            'count'=>$request->input('count')
        ]);

        return redirect()->route('cart');
    }
}
