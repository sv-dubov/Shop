<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    {{--<link rel="stylesheet" href="{{ asset('/css/app.css') }}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('public/js/site.js') }}"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Brand and button «Hamburger» -->
        <a class="navbar-brand" href="{{ route('index') }}">Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbar-example" aria-controls="navbar-example"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Main part of the menu (may contains links, forms and others) -->
        <div class="collapse navbar-collapse" id="navbar-example">
            <!-- Left side block -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog.index') }}">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Delivery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacts</a>
                </li>
            </ul>
            <!-- Center side block -->
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search"
                       placeholder="Поиск по каталогу" aria-label="Search">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
            <!-- Right side block -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('basket.index') }}">Basket</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-3">
            @include('layout.partial.roots')
            @include('layout.partial.brands')
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
