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
        $ps = Product::with(['product_seller' => function ($query) {
            $query->withCount('order_product_sellers');
        }])->get();
        
        foreach ($ps as $p) {
            $p->sum = $p->product_seller->sum(function ($region) {
                return $region->order_product_sellers_count;
            });
        }

        $populars = $ps->sortByDesc('sum')->take(5);

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
            'popular' => $populars,
            'cats' => $cats
        ]);
    }
}
