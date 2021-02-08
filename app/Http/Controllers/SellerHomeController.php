<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSeller;
use Illuminate\Http\Request;

class SellerHomeController extends Controller
{    
    public function index()
    {

        // $products = ProductSeller::where('seller_id', auth()->user()->profile->id)->get()->pluck('product')->flatten();
        // $d= ProductSeller::where('seller_id', auth()->user()->profile->id)->get()->pluck('price')->flatten();
        // for($i=0 ; $i<count($products) ;$i+=1){
        //     $products[$i]->price = $d[$i];
        // }

        $productSellers = ProductSeller::where('seller_id', auth()->user()->profile->id)
        ->with('product')->paginate(12);
        
        // $p = Product::with(['sellers'])->get();
        // dd($p[0]->sellers[0]);
        return view('home.sellers',['productSellers' => $productSellers]);
    }
}
