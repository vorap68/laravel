@extends('auth.layouts.master')

@section('title', 'Продукт ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>{{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id}}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Название en</td>
                <td>{{ $product->name_en }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Описание en</td>
                <td>{{ $product->description_en }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img src="{{ Storage::url($product->image) }}" height="240px"></td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr><td>Количество</td>
                <td>{{$product->count}}</td>
            </tr>
            <tr>
                 <div class="labels">
           @if($product->isNew())
            <span class="badge badge-success">Новый</span>
            @endif

           @if($product->isHit())
            <span class="badge badge-danger">Хит</span>
             @endif
             
             @if($product->isRecommend())
            <span class="badge badge-warning">Рекомендуемый</span>
            @endif
        </div>
              
            </tr>
            </tbody>
        </table>
    </div>
@endsection
