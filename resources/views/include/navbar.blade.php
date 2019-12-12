<!DOCTYPE html>
<html>
<head>
<title>Alleen de beste restaurants in Rotterdam - Rotterdambezorgd.nl</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<script src="https://kit.fontawesome.com/1cde44e559.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/cart.js') }}" async></script>
<script src="{{ asset('js/js.js') }}" async></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<nav class="navbar navbar-expand-md fixed-top">
    <div class="w-100 order-1 order-md-0">
        <a href="{{ url('/') }}"><img class="nav-logo" src="{{URL('/images/logo.png')}}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
    </div>
    <div class="mx-auto order-0 md-form mt-0 w-100">
        <input class="form-control" type="text" placeholder="Vind restaurant" aria-label="Search">
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

    
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item dropdown">
                <a id="navbarDropdown" style="font-weight:600;color:#FAF6D5 !important" class="fas fa-bars nav-icon-right"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" style="font-weight:600;color:#FAF6D5 !important" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    <span>     </span>
                    <i class="fas fa-bars nav-icon-right"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->role < 3)
                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                    @endif
                    <a class="dropdown-item" href="/user">
                        Mijn gegevens
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>
</head>
<body class="body-padding-top">
