<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- FontAwesome (For Icons) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
          <!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
integrity="sha384-7xZNYU+4d9V5w5Om+Nl+lmfRBB3+2sqjNE3c9k3XqGpG1Mw3m5Z6LO3R4O1w+E9s" crossorigin="anonymous"/>


    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Vite for Laravel Mix -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <a href="{{ route('users.index') }}" class="btn btn-outline rounded-pill"><i class="fa fa-user"></i> Users</a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline rounded-pill"><i class="fa fa-box"></i> Products</a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i> Cashier</a>
                        <a href="#" class="btn btn-outline rounded-pill"><i class="fa fa-file"></i> Reports</a>
                        <a href="#" class="btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i> Transactions</a>
                        <a href="#" class="btn btn-outline rounded-pill"><i class="fa fa-chart"></i> Suppliers</a>
                        <a href="#" class="btn btn-outline rounded-pill"><i class="fa fa-users"></i> Customers</a>
                        <a href="#" class="btn btn-outline rounded-pill"><i class="fa fa-chart"></i> Incoming</a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
            integrity="sha384-7xZNYU+4d9V5w5Om+Nl+lmfRBB3+2sqjNE3c9k3XqGpG1Mw3m5Z6LO3R4O1w+E9s" crossorigin="anonymous"></script>

    @stack('scripts')

    <style>
        .btn-outline {
            border-color: #008B8B;
            color: #008B8B;
        }
        .btn-outline:hover {
            background-color: #008B8B;
            color: #fff;
        }

        .card-header{
            background: rgb(52, 73, 94);
            color: #fff;
        }

        
    
    </style>

    
</body>
@yield('script')
</html>
