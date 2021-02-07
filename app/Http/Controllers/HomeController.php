<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProductSeller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {

        $products = OrderProductSeller::join('product_seller', 'product_seller_id', '=', 'product_seller.id')
            ->join('products', 'product_seller.product_id', '=', 'products.id')
            ->select('*', DB::raw('count(*) as total'), DB::raw('min(product_seller.price) as min_price'))
            ->groupBy(['order_product_sellers.id', 'product_seller.id', 'products.id'])
            ->orderBy('total', 'DESC')
            ->get();

        // dd($products[3]->min_price);
        // find categories in depth 3 or 2
        $cats = Category::whereNotNull('parent_id')
            // whereHas('parentCategory', function ($q) {
            //     $q->whereNotNull('parent_id');
            // })
            ->inRandomOrder()->limit(5)->get();

        foreach ($cats as $cat) {
            $CatProducts = Product::where('category_id', $cat->id)
                ->join('product_seller', 'product_seller.product_id', '=', 'products.id')
                ->select('*', DB::raw('min(price) as minPrice'))
                ->groupBy(['products.id', 'product_seller.id'])
                ->limit(5)
                ->get();
            $cat['products'] = $CatProducts;
        }

        return view('home.index', [
            'popular' => $products,
            'cats' => $cats
        ]);
    }
}
