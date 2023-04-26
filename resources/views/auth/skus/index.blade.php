@extends('auth.layouts.master')

@section('title', 'Товарные предложения')

@section('content')
    <div class="col-md-12">
        <h1>Товарные предложения</h1>
        <h1>{{$product->name}}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                
            </tr>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $sku->id }}</td>
                   
                    <td>{{ $sku->product->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('skus.destroy',[$product,$sku]) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('skus.show', [$product,$sku]) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('skus.edit', [$product,$sku]) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       
        <a class="btn btn-success" type="button"
           href="{{ route('skus.create',$product) }}">Добавить SKUS</a>
    </div>
@endsection
