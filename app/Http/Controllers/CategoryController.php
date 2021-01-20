<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{


    public function index(Category $category)
    {
        $ids = array($category->id);
        $this->addtoArray($ids, $category);
        
        $products = Product::whereIn('category_id' , $ids)->with(['product_seller'])->paginate(2);

        return view('category.index',[
            'category' => $category,
            'products' => $products
        ]);
    }


    public function addtoArray(Array &$arr, Category $category)
    {
        foreach($category->subcategory as $sub){
            array_push($arr, $sub->id);
            $this->addtoArray($arr, $sub);
        }
    }

}
