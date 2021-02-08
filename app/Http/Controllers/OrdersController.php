<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use Illuminate\Support\Facades\DB;

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

        return view('order.list', [
            'orders' => $orders
        ]);
    }

    public function indexSellers()
    {

        $productSellers = ProductSeller::where('seller_id', auth()->user()->profile->id)
            ->with(['order_product_sellers.order', 'order_product_sellers', 'product'])
            // ->whereHas('order_product_sellers.order', function ($order) {
            //     return $order->where('is_done', true);
            // })
            ->get();

        foreach ($productSellers as $productSeller) {
            $productSeller->sum = $productSeller->order_product_sellers->sum(function ($region) {
                if ($region->order->is_done)
                    return $region->count;
                else
                    return 0;
            });
        }

        $productSellers = $productSellers->filter(function ($item) {
            return $item->sum > 0;
        })->values();

        return view('order.list_seller', [
            'productSellers' => $productSellers
        ]);
    }
}
