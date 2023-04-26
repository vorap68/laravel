<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{__('main.online_shop')}} @yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <!--        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/starter-template.css" rel="stylesheet">
    </head>

    <body class="d-flex flex-column justify-content-between">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <a class="navbar-brand" href="#">{{__('main.online_shop')}}:User</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active' : ''}}">
                                <a class="nav-link" 
                                   @if(Auth::check() && Auth::user()->isAdmin())href="{{route('products.index')}}">
                                   @else href="{{route('index')}}">
                                   @endif
                                   {{__('main.all_products')}} <span class="sr-only">(current)</span></a>
                            </li>



                            <li class="nav-item {{ request()->is('categories') ? 'active' : ''}}" >
                                <a class="nav-link" href="{{route('categories')}}">Категории</a>
                            </li>
                            @auth
                            <li class="nav-item {{ request()->is('basket') ? 'active' : ''}}" >
                                <a class="nav-link" href="{{route('basket')}}">В корзину</a>
                            </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('locale',__('main.set_lang'))}}">{{__('main.set_lang')}}</a>
                            </li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">{{App\Models\Currency::byCode(session('currency','UAH'))->first()->symbol}}
                                </button>
                                <div class="dropdown-menu">
                                    @foreach(App\Models\Currency::all() as $currency)
                                    <a class="dropdown-item" href="{{route('currency',$currency->code)}}">{{$currency->symbol}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @guest
                            <li><a href="{{ route('login') }}">АдминПанель</a></li>
                            @endguest

                            @auth

                            <li class="nav-item mr-3">
                                <a href="{{route('person.orders.index')}}"> Заказы {{Auth::user()->name}}</a>
                            </li>
                            <li class="nav-item ">
                                <a  href="{{ route('get.logout') }}">Выйти</a>

                            </li>
                            @endauth
                        </ul>
                    </div>

                </div>
            </nav>
        </div>        <div class="starter-template">
            @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
            @yield('content')
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6"><p>Категории</p>
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{route('category',$category->code)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
                 <div class="row">
                    <div class="col-lg-6"><p>Популярные товары</p>
                        <ul>
                           
                            <li><a href="#">product</a></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>