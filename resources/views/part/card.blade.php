<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
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
        <img src="{{Storage::url($product->image)}}" alt="{{$product->name}}">


        <div class="caption">
            <h3>{{$product->name}}</h3>
            <p>{{$product->price}}</p>
            <p>
            <form action="{{route('basket.add',$product->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary" >В корзину</button>
               <a href="{{route('product',$product->id)}}" class="btn btn-default" role="button">Подробнее</a>
            </form>  
            </p>
        </div>
    </div>
</div>