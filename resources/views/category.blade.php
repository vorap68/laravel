
@extends('layouts.master')

@section('title','категория:'.$category->name)
@section('content')
         
                                 <h1>  {{$category->name}} {{$category->products->count()}}</h1>
                 
             
                
                    <h1>  {{$category->description}}</h1>
                    <div class="row">
                 @foreach($category->products as $product)
                 @include('part.card')
                 @endforeach
                </div>
       @endsection