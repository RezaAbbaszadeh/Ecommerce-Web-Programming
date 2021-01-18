<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {

        $cats = Category::get();
        dd($cats);
        return view('categoryController');
    }
}
