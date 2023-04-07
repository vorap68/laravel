<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
   
    public function index()
    {
        $products = Product::all();
        return view('auth.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('auth.products.form',compact('categories'));
    }

  
    public function store(ProductRequest $request)
    {
    if($request->file('image')){
       $path = $request->file('image')->store('products');
    } else {
        $path = 'default.jpg';
    }
       $params = $request->all();
       $params['image'] = $path;
       foreach (['hit','new','recommend'] as $fieldname){
           if(isset($params[$fieldname])){
               $params[$fieldname] = 1;
           }
         }
     Product::create($params);
        $products = Product::all();
        return view('auth.products.index',compact('products'));
    }

   
    public function show(Product $product)
    {
        return view('auth.products.show',compact('product'));
    }

   
    public function edit(Product $product)
    {
        $categories = Category::all();
        
        return view('auth.products.form',compact('product','categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
         $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
        Storage::delete($product->image);
         $path = $request->file('image')->store('products');
       $params['image'] = $path;
        }
        foreach (['hit','new','recommend'] as $fieldname){
           if(isset($params[$fieldname])){
               $params[$fieldname] = 1;
           }else $params[$fieldname] = 0;
         }
       $product->update($params);
          return view('auth.products.show',compact('product'));
    }

   
    public function destroy(Product $product)
    {
        $product->delete();
           $products = Product::all();
        return view('auth.products.index',compact('products'));
    }
}
