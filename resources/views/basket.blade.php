@extends('layouts.master')

@section('title', __('basket.cart'))

@section('content')
<div class="container">
 <div class="starter-template">
    <h1>Корзина</h1>
    
    <div class="panel">
        <table class="table table-striped">
            <thead>     
            <tr>
                <th>название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
           @foreach($order->products as $product)
           <tr>
               <td>
                   <a href="{{route('product',$product)}}">33{{$product->name}}</a>
               </td>
               <td><span class="badge">{{$product->pivot->count}}</span>
                   <div class="btn-group form-inline">
                       <form  action="{{ route('basket.remove',$product->id) }}" method="POST">
                           <button type="submit" class="btn btn-danger" href=""> 
                               <i class="fas fa-minus-square"></i></button>
                           @csrf
                       </form>
                       <form action="{{ route('basket.add',$product->id) }}" method="POST">
                           <button type="submit" class="btn btn-success">
                               <i class="fas fa-plus-square"></i></button>
                           @csrf
                       </form>
                   </div>
               </td>
               <td>{{$product->price}}</td>
               <td>{{$product->getPriceForCount()}}</td>
           </tr>
         @endforeach
          <tr>
                <td colspan="3">Итого</td>
                <td>{{$order->getFullSum()}}</td>
              
                  
                    
              
           
            </tr>
                       </tbody>
        </table>
           </div>
 </div> 
      <div class="row">
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success"
                   href="{{ route('basket.place') }}">Подтвердите заказ</a>
            </div>
        </div> 
</div>  
  
@endsection
