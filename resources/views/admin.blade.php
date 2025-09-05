<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: rgb(185, 168, 214);
        }
        .card-header {
            background-color: #591f61;
            color: #ffffff;
        }
        .card {
            margin-top: 20px;
        }
        .post-content {
            margin-bottom: 20px;
        }
        .delete-btn {
            background-color: #591f61;
            border: 1px solid rgb(23, 11, 29);
            color: white;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #7d338c;
        }
        /* Additional styles */
        .user-item {
            list-style-type: none; /* Remove bullet points */
            margin-bottom: 10px; /* Add margin bottom */
        }
        .user-item strong {
            margin-right: 10px; /* Space between name and button */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: rgb(185,168,214);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name','ফোরাম') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('লগইন') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('রেজিস্টার') }}</a>
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
                                        {{ __('লগ আউট') }}
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
        <!-- Main Content -->
        <main class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">সব পোষ্ট</div>
                        <div class="card-body">
                            @foreach($posts->reverse() as $post)
                                <div class="post-content" style="background-color: rgb(185, 168, 214); padding: 10px; margin: 10px;">
                                    <div>
                                        @if($post->anonymous)
                                            <p><em>অ্যানোনিমাস পোষ্ট</em></p>
                                        @else
                                            <p><strong>{{ $post->user->name }}</strong></p>
                                        @endif
                                        <h4 style="font-size: 15px">{{ $post['created_at'] }}</h4>
                                    </div>
                                    <div>
                                        <h3><strong>{{ $post['title'] }}</strong></h3>
                                        <p>{{ $post['body'] }}</p>
                                        <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this post?')" class="delete-btn">মুছে ফেলুন</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">All Accounts</div>
                        <div class="card-body">
                            
                            <ul>
                                @foreach($users as $user)
                                <li class="user-item">
                                    <strong>{{ $user->name }}</strong> 
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Initialize Bootstrap components that require JavaScript
        $(document).ready(function() {
            // Enable Bootstrap dropdowns
            $('.dropdown-toggle').dropdown();
        });
    </script>

    {{-- @section('content') --}}
    <div class="container">
        <div class="row" style="background-color: rgb(185, 168, 214); padding: 10px; margin: 10px;">
            <div class="col-md-12" >
                <h2>Reported Post</h2>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                
                        @foreach($posts as $post)

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->body }}</p>
                                <p>Posted at: {{$post->created_at}}</p>
                            </div>
                        </div>
                    @endforeach

                        
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</body>
</html>
