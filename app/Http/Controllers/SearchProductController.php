<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Error;
use Illuminate\Http\Request;
use SplFileInfo;

class SearchProductController extends Controller
{
    public function search(Request $request)
    {
        if (empty($request->input('name'))) {
            return "";
        }
        $search = explode(" ", $request->input('name'));
        $result = Product::where('name', 'LIKE', '%' . $search[0] . '%')->with(['category'])->get();
        for ($i = 1; $i < count($search); $i++) {
            $p = Product::where('name', 'LIKE', '%' . $search[$i] . '%')->with(['category'])->get();
            $result = $result->merge($p);
        }

        foreach ($result as $pro) {
            $cat = Category::where('id', $pro->category_id)->get()->first();
            if ($cat != null)  {  
                $parent = $cat->parentCategory;
                $grandparent = $parent->parentCategory;
                if($cat->parent_id == null){
                    $pro['cat1'] = $cat;
                    $pro['cat2'] = "";
                    $pro['cat3'] = "";
                }
                else if($parent->parent_id == null){
                    $pro['cat1'] = $parent;
                    $pro['cat2'] = $cat;
                    $pro['cat3'] = "";
                }else{
                    $pro['cat1'] = $grandparent;
                    $pro['cat2'] = $parent;
                    $pro['cat3'] = $cat;
                }

            }
        }
        return $result->toJson();
    }
}
