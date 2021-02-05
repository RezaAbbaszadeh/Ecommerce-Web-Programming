<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSeller;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AddProductController extends Controller
{
    use UploadTrait;

    public function index()
    {

        $cats1 = Category::whereNull('parent_id')->get();

        $depth1 = array();
        $depth2 = array();
        $depth3 = array();
        foreach ($cats1 as $cat1) {
            array_push($depth1, ['name' => $cat1->name, 'id' => (string)$cat1->id]);
            $cats2 = $cat1->subcategory;
            foreach ($cats2 as $cat2) {
                array_push($depth2, ['name' => $cat2->name, 'id' => (string)$cat2->id, 'car' => (string)$cat1->id]);
                $cats3 = $cat2->subcategory;
                foreach ($cats3 as $cat3) {
                    array_push($depth3, ['name' => $cat3->name, 'id' => (string)$cat3->id, 'model' => (string)$cat2->id]);
                }
            }
        }
        // dd($depth2);

        return view('seller.add', [
            'depth1' => $depth1,
            'depth2' => $depth2,
            'depth3' => $depth3,
        ]);
    }


    public function store(Request $request)
    {
        $ex = $request->input('existing-product');
        if ($ex == "") {
            $cat = $request->input('cat3');
            if (!$cat)
                $cat = $request->input('cat2');
            if (!$cat)
                $cat = $request->input('cat1');

            $request->merge(['category' => $cat]);

            $this->validate($request, [
                'name' => 'required|max:255',
                'count' => 'required|integer|min:0',
                'price' => 'required|min:0|regex:/^\d*(\.\d{2})?/',
                'img' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:ratio=1/1',
                'category' => 'required'
            ]);

            $image = $request->file('img');
            $name = Str::slug($request->input('name')) . '_' . time();
            $folder = '/images/products/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            $product = Product::create(['name' => $request->input('name'), 'img_url' => $filePath, 'category_id' => (int)$cat]);

            $product->sellers()->attach(auth()->user()->profile->id, ['count' => $request->input('count'), 'price' => $request->input('price')]);
        } else {
            $product = Product::where('id', $ex)->get()->first();

            $product_seller = $product->product_seller->first(function ($item) use ($product) {
                return ($item->seller_id == auth()->user()->profile->id) and ($item->product_id == $product->id);
            });

            if ($product_seller == null)
                $product->sellers()->attach(auth()->user()->profile->id, ['count' => $request->input('count'), 'price' => $request->input('price')]);
            else{
                $product_seller->count = $product_seller->count + $request->input('count');
                $product_seller->price = $request->input('price');
                $product_seller->save();
            }
            
        }

        return redirect()->route('home.sellers');
    }
}
