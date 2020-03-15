<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="style.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="css/custom.css">

	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body style="background-image: url('images/Library\ copy.jpg');background-repeat:no-repeat;background-size:cover;">
    <div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header head">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<div class="logo">
							<a href="{{ url('/Book') }}">
								<img src="images/logo/logo.png" alt="logo images">
							</a>
						</div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block">
						<nav class="mainmenu__nav" style="float:right">
							<ul class="meninmenu d-flex justify-content-start">
                                @guest
                                    <li class="drop with--one--item"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    @if (Route::has('register'))
                                    <li class="drop with--one--item"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>                             
                                    @endif
                                    @else 
                                    <li class="drop"><a class="user" href="#">{{ Auth::user()->name }}</a>
                                        <div class="megamenu mega03">
                                            @can('isAdmin',App\User::class)
                                            <ul class="item item03">
                                                <li class="title">Admin Layout</li>
                                                <li><a href="{{ route('admin.users.index') }}">User Management</a></li>
                                                <li><a href="{{ route('category.index') }}">Categories</a></li>
                                                <li><a href="{{ route('Book.index') }}">Book Management</a></li>
                                                <li><a href="{{ route('Book.profits') }}">Profit Chart</a></li>
                                                <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </a></li>
                                            </ul>
                                            @endcan
                                            @cannot('isAdmin', App\User::class)
                                            <ul class="item item03">
                                                <li class="title">User Layout</li>
                                                <li><a href="/favourites">Favourite Books</a></li>
                                                <li><a href="{{ route('profile.edit', Auth::user()) }}">Edit Profile</a></li>
                                                <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </a></li>
                                            @endcan
                                            </ul>
                                        </div>
                                    </li>
                                    @endguest	
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div style="margin-top:6rem">
        <main class="py-4">
                            @yield('content')
                        </main>
        </div>
</body>
</html>