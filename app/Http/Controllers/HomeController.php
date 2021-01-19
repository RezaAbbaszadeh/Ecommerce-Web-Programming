<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // $p = Product::with(['sellers'])->get();
        // dd($p[0]->sellers[0]);
        return view('home.index');
    }
}
