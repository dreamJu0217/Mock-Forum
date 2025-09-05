@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
</head>
<body>
        <div class="navbar-links">
            {{-- @if (Route::has('login'))
                @auth
                {{-- <a href="{{ route('home') }}" class="font-semibold text-white-600 hover:text-white-900 dark:text-white-400 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a> --}}
                {{-- @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif --}}
            
        </div>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-white-900 selection:bg-red-500 selection:text-white">
        <!-- Your existing content here -->
    </div>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-white-900 selection:bg-red-500 selection:text-white">
        <div class="container">
            <h1>ফোরাম এ আপনাদের স্বাগতম</h1>
            <ul>
                
                @auth
                <button onclick="window.location.href='{{ route('home') }}'" class="profile-button" style="background-color: #420a494d; 
                    border: 1px solid rgb(23, 11, 29);
                    color: rgb(255, 255, 255);
                    padding: 5px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 2px 1px;
                    cursor: pointer;">হোম
                    </button>

                    <button onclick="window.location.href='{{ url('/profile') }}'" class="profile-button" style="background-color: #420a494d; 
                    border: 1px solid rgb(23, 11, 29);
                    color: rgb(255, 255, 255);
                    padding: 5px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 2px 1px;
                    cursor: pointer;">আমার প্রোফাইল
                    </button>
                @endauth
            </ul>
        </div>
    </div>
</body>

</html>
@endsection