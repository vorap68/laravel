@extends('layouts.master')

@section('content')
            <div class="container">
                <div class="starter-template">
                  

                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="labels">


                                </div>
                                <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg" alt="iPhone X 64GB">
                                <div class="caption">
                                    <h3>{{$product->name}}</h3>
                                        <p>{{$product->price}}</p>
                                    <p>
                                    <form action="http://internet-shop.tmweb.ru/basket/add/1" method="POST">
                                        Не доступен                                <a href="http://internet-shop.tmweb.ru/mobiles/iphone_x_64"
                                                                                      class="btn btn-default"
                                                                                      role="button">Подробнее</a>
                                        <input type="hidden" name="_token" value="8HdYheLh7oUiALpw0zZw9Bc3bzkgYRRddRUC2uvR">            </form>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                         <div class="labels">
           @if($product->isNew())
            <span class="badge badge-success">Новый</span>
            @endif

            @if($product->isRecommend())
            <span class="badge badge-warning">Рекомендуемый</span>
            @endif

            @if($product->isHit())
            <span class="badge badge-danger">Хит</span>
            @endif
        </div>
                 
                    </div>
                 
                </div>
            </div>
   @endsection