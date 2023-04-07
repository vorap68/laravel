<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories = Category::all();
        return view('auth.categories.index',compact('categories'));
    }

   
    public function create()
    {
        return view('auth.categories.form');
    }

   
    public function store(CategoryRequest $request)
    {
        $path = $request->file('image')->store('categories');
        $params = $request->all();
        $params['image'] = $path;
       Category::create($params);
         $categories = Category::all();
        return view('auth.categories.index',compact('categories'));
      
    }

    public function show(Category $category)
    {
        return view('auth.categories.show',compact('category'));
    }

  
    public function edit(Category $category)
    {
        return view('auth.categories.form',compact('category'));
    }

   
    public function update(CategoryRequest $request, Category $category)
    {       
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
           Storage::delete($category->image); 
           $path = $request->file('image')->store('categories');
        $params['image'] = $path;
        }
       $category->update($params);
            return view('auth.categories.show',compact('category'));
    }

  
    public function destroy(Category $category)
    {
        $category->delete();
          $categories = Category::all();
        return view('auth.categories.index',compact('categories'));
    }
}
