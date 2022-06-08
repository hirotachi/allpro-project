<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return new ProductCollection(Product::orderBy('id', 'desc')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create($validated);
        if(request()->has('categories')){
            $categories = array_map(function($val){
                return ["name"=>  $val];
            }, request()->get('categories'));
            
            Category::upsert($categories, ["name"]);
            $categories = Category::whereIn('name', $categories)->get();
            $categoryIds = $categories->pluck('id');
            $product->categories()->sync($categoryIds);
        }
        return new ProductResource($product);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        $product = Product::findOrFail($id);
        $product->update(request()->all());
        if(request()->has('categories')){
            $categories = array_map(function($val){
                return ["name"=>  $val];
            }, request()->get('categories'));
            Category::upsert($categories);
            $categories = Category::whereIn('name', $categories)->get();
            $categoryIds = $categories->pluck('id');
            $product->categories()->sync($categoryIds);
        }
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return string[]
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return ["message" => "Product deleted"];
    }
}
