 @extends('layouts.master')

@section('title', __('basket.cart'))

@section('content')
   
         <h1>Подтвердите заказ:</h1>
         <div class="container">
        <div class=" justify-content-center">
            <p>Полная стоимость: <b>{{ $order->getFullSum() }}</b></p>
         
            <form action="{{ route('basket.confirm') }}" method="POST">
                <div>
                    <p>Укажите ваши данные:</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Телефон: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" >
                </div>
            </form>
        </div>
    </div>

@endsection