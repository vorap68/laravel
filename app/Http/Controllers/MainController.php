<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
//use DebugBar\DebugBar;
use Illuminate\Support\Facades\App;
use App\Models\Currency;
use App\Services\CurrencyRates;

class MainController extends Controller
{
    public function index(Request $request){
      // session()->flush();
        $productQuery = Product::with('category');
       if($request->filled('price_from')) $productQuery-> where('price','>=',$request->price_from);
       if($request->filled('price_to')) $productQuery-> where('price','<=',$request->price_to);
       if($request->filled('new')) $productQuery-> where('new',1);
       if($request->filled('hit')) $productQuery-> where('hit',1);
       if($request->filled('recommend')) $productQuery-> where('recommend',1);
       
        $products = $productQuery->paginate(4)->withPath("?".$request->getQueryString());
        //dd($products);
        return view('index', compact('products'));
    }
    
     public function categories(){
       
        return view('categories');
    }
    
     public function product($id = null){
        // dd($product);
         $product = Product::find($id);
        return view('product',compact('product'));
    }
    
    public function category($code){
       // dd($code);
        $category = Category::where('code',$code)->first();
       // $products = Product::where('category_id',$category->id)->get();
       // dd($products);
      return view('category',compact('category'));
    }
    
    public function changeLocale($locale) {
        session(['locale'=>$locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
    
    public function changeCurrency($currencyCode) {
         //dd($currencyCode);
        $currency = Currency::byCode($currencyCode)->firstOrFail();
       // dd($currency);
        session(['currency' => $currency->code]);
        return redirect()->back();
    }
  
}
