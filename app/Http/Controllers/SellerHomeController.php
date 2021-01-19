<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerHomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['seller']);
    }
    
    public function index()
    {
        return view('home.sellers');
    }
}
