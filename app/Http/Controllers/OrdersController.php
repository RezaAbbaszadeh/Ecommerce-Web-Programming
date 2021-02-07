<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {

        $orders = Order::where('customer_id', auth()->user()->profile->id)
            ->with([
                'order_product_sellers',
                'order_product_sellers.product_seller',
                'order_product_sellers.product_seller.product'
            ])
            ->get();

        foreach ($orders as $order) {
            $order->sum = $order->order_product_sellers->sum(function ($region) {
                return $region->count * $region->product_seller->price;
            });
        }

        // dd($orders);

        return view('order.list',[
            'orders'=>$orders
        ]);
    }
}
