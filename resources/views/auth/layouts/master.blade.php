<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>АдминПанель: @yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <!--        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <script src="/js/app.js" defer></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/starter-template.css" rel="stylesheet">
    </head>

    <body class="d-flex flex-column justify-content-between">


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">{{__('main.online_shop')}}:Admin</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Интернет магазин <span class="sr-only">(current)</span></a>
                        </li>
                         @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products.index')}}">Все товары</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('categories.index')}}"">Категории</a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('property.index')}}">Свойства</a>
                        </li>
                        
                     @endauth
                      <li class="nav-item">
                                 <a class="nav-link" href="{{route('locale','ru')}}"> Переключатель языка</a>
                               
                            </li>
                    </ul>
                    @guest
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                        </li>
                    </ul>
                    @endguest
                    @auth
                    <li class="nav-item mr-3">
                    <a href="{{route('home')}}"> Заказы {{Auth::user()->name}}</a>
                </li>
                    <li class="nav-item ">
                        <a  href="{{ route('get.logout') }}">Выйти</a>
                            
                    </li>
                @endauth
                </div>
            </div>
        </nav>


        <div class="starter-template">
            @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
            @yield('content')
        </div>

    </body>
</html>