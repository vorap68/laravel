@extends('layouts.master')

@section('title','Главная')
@section('content')
<div class="container">
    <h1>Все товары</h1>
    
    <form method="GET" action="{{route("index")}}" class="border">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="price_from">Цена от
                    <input type="text" name="price_from" id="price_from" size="6" value="">
                </label>
                <label for="price_to">Цена до
                    <input type="text" name="price_to" id="price_to" size="6"  value="">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                    <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif> Хит
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif> Новые
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommend">
                    <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked @endif> Рекомендованные
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">Фильтровать</button>
                <a href="{{ route("index") }}" class="btn btn-warning">Сбросить</a>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        @foreach($products as $product)
        @include('part.card')
        @endforeach
    </div>
    {{$products->links()}}
</div>
@endsection