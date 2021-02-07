<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\View\Components\ProductComponent;

class CategoryController extends Controller
{


    public function index(Category $category)
    {
        $ids = array($category->id);
        $this->addtoArray($ids, $category);

        $products = Product::whereIn('category_id', $ids)
            ->join('product_seller', 'product_seller.product_id', '=', 'products.id')
            // ->select('*', DB::raw('min(product_seller.price) as min_price'))
            // ->where('product_seller.price', '<', 1000)
            // ->groupBy(['products.id', 'product_seller.id'])
            ->paginate(8);

        return view('category.index', [
            'category' => $category,
            'products' => $products
        ]);
    }

 /*   public function filter(Category $category, $min, $max)
    {
        dd($min);
        $ids = array($category->id);
        $this->addtoArray($ids, $category);

        $products = Product::whereIn('category_id', $ids)
            ->join('product_seller', 'product_seller.product_id', '=', 'products.id')
            // ->select('*', DB::raw('min(product_seller.price) as min_price'))
            ->where('product_seller.price', '<', 1000)
            // ->groupBy(['products.id', 'product_seller.id'])
            ->paginate(8);

        return view('category.index', [
            'category' => $category,
            'products' => $products
        ]);
    }*/

    /*    public function filter(Request $request)
    {
        $category = Category::find($request['category_id']);
        $ids = array($category->id);
        $this->addtoArray($ids, $category);

        $products = Product::whereIn('category_id', $ids)->with(['product_seller'])->paginate(8);

        $result = "";

        foreach ($products as $product) {
            $price = $product->minPrice();
            if ($price < 1000) {
                $result .= "<div class='product_item col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 p-0'>" .
                    View::make(
                        "components.product_model",
                        [
                            'product' => $product,
                            'price' => $price
                        ]
                    )->render() . "</div>";
            }
        }

        $res = array(
            'data' => $result,
            'links' => $products->links()->render()
           );
        return $res;
    }
*/

    public function addtoArray(array &$arr, Category $category)
    {
        foreach ($category->subcategory as $sub) {
            array_push($arr, $sub->id);
            $this->addtoArray($arr, $sub);
        }
    }
}
