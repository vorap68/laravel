@extends('layouts.master')

@section('content')
            <div class="container">
                <div class="starter-template">
                  

                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="labels">


                                </div>
                                <img src="{{Storage::url($product->image)}}" alt="iPhone X 64GB">
                                <div class="caption">
                                    <h3>{{$product->name}}</h3>
                                       Цена товара <p>{{$product->price}}</p>
                                    <p>
                                    <form action="{{route('basket.add',$product->id)}}" method="POST">
                                      @csrf
                                        @if($product->isAvailable())<button type="submit" class="btn btn-primary" >В корзину</button>
                                        @else <p>Товар недоступен</p>
                                        @endif                         
                                       </form>
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