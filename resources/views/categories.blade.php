@extends('layouts.master')

@section('title','Все категории')

@section('content')

            <div class="container">
                <div class="starter-template">
                    @foreach($categories as $category)
                    <h1><a href="{{route('category',$category->code)}}">
                              <img src="{{Storage::url($category->image)}}" alt="iPhone X 64GB">
                              {{$category->name}}</a></h1>
                    <h3>{{$category->description}}</h3>
                  @endforeach
                </div>
            </div>
  @endsection