<?php

namespace App\Http\Controllers;

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
}
