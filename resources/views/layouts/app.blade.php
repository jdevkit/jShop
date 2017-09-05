<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyApp') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="page-wrapper">

        <div id="header-wrapper">
            <header id="header" class="container">
                <div class="row">
                    <div class="12u">

                        <!-- Logo -->
                        <h1><a href="{{ url('/') }}" id="logo"> {{ config('app.name', 'Laravel') }}</a></h1>

                        <!-- Nav -->
                        <nav id="nav">
                            @if (Auth::guest())
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            @else

                                <a href="{!! route('user.cart.show') !!}" class="button-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    Cart <span class="cart badge">0</span>
                                </a>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        </nav>

                    </div>
                </div>
            </header>


        </div>
        <div id="features-wrapper">
            <div id="features">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/js/cart-header.js"></script>
    @yield('scripts')

</body>
</html>
