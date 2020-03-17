<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @extends('layouts.app')
        @section("content")
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            </div>
        </div>
        <div  style="text-align:left;margin-top:100px; margin-left:20px;">
            <h2>About Us</h2>
            <h3>Open Source Applications team includes the following names:</h3>
            <ul style="margin-left:60px; font-size:larger;display: list-item;list-style-type: circle;">
                <li>Mohamed Adham</li>
                <li>Mohamed Tarek</li>
                <li>Mohamed Zakaria</li>
                <li>Rehab Ayman</li>
                <li>Nouran M.Yehia</li>                
            </ul>
        </div>
    </body>
</html>
