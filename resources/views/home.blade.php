@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #f0f0f0;"> 
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('search') }}" method="GET">
                
                <label for="category">ক্যাটেগরি দিয়ে খুজুন:</label>
                        <select name="category" id="category" class="form-control" required>
                            @foreach(['sports', 'movie', 'question'] as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="query" placeholder="শিরোনাম দিয়ে খুঁজুন..." style="width: 300px;">
                <button type="submit" style="background-color: #420a494d; 
                border: 1px solid rgb(23, 11, 29);
                color: rgb(255, 255, 255);
                padding: 5px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 2px 1px;
                cursor: pointer;">খুঁজুন
                </button>
            </form>
            <a href="{{ auth()->check() ? route('show') : route('login') }}">
                <button id="myProfileButton" style="background-color: #420a494d; /* Same background color as search button */
                    border: 1px solid rgb(23, 11, 29);
                    color: rgb(255, 255, 255);
                    padding: 10px 32px; /* Increased padding */
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 20px; /* Increased font size */
                    margin-top: 20px; /* Added margin */
                    cursor: pointer;">আমার প্রোফাইল
                </button>
            </a>
            <div class="row mt-2">
                <div class="col-md-12 text-center">
                    <form action="{{ route('compose') }}" method="GET" style="display: inline-block; margin-right: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="background-color: #591f614d; 
                            border: 1px solid rgb(23, 11, 29);
                            color: white;
                            padding: 5px 55px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 20px;
                            cursor: pointer;">
                            বার্তা
                        </button>
                    </form>
                   
                    <form action="{{ route('inbox') }}" method="GET" style="display: inline-block;">
                        @csrf
                        
                        <button type="submit" class="btn btn-secondary" style="background-color: #591f614d; 
                            border: 1px solid rgb(23, 11, 29);
                            color: white;
                            padding: 5px 55px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 20px;
                            cursor: pointer;">
                            ইনবক্স
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
        <div class="col-md-8">
            <h2><strong>একটি নতুন পোস্ট বানান </strong></h2>
            
            <div style="background-color: rgb(185, 168, 214); padding: 10px; margin: 10px;font-size: 20px;">
                <form action="/create-post" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category">ক্যাটেগরি:</label>
                        <select name="category" id="category" class="form-control" required>
                            @foreach(['sports', 'movie', 'question'] as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="title" placeholder="পোস্ট শিরোনাম" style="font-size: 12px;"><br>
                    <textarea name="body" placeholder="লিখুন..." style="font-size: 12px;"></textarea><br>
                    <input type="checkbox" id="anonymous" name="anonymous">
                    <label for="anonymous">অ্যানোনিমাস পোষ্ট</label><br>
                    <button style="background-color: #591f614d; 
                 border: 1px solid rgb(23, 11, 29);
                 color: white;
                 padding: 5px 32px;
                 text-align: center;
                 text-decoration: none;
                 display: inline-block;
                 font-size: 16px;
                 margin: 2px 1px;
                 cursor: pointer;">সেভ করুন
                 </button>

                </form>
            </div>
            <h2><strong>সব পোষ্ট</strong></h2>
            @foreach($posts->reverse() as $post)
            {{-- @php
                $blocked = auth()->user() ? auth()->user()->isBlocking($post->user) : false;
            @endphp
            @if(!$blocked) --}}
            <div style="background-color: rgb(185, 168, 214); padding: 10px; margin: 10px;font-size: 20px;">
                {{-- <h3 style="display: inline-block;"><strong>{{$post->user->name}}</strong></h3> --}}
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        @if($post->anonymous)
                        <p><em>অ্যানোনিমাস পোষ্ট</em></p>
                        @else
                        <p><strong>{{ $post->user->name }}</strong></p>
                        @endif
                        <h4 style="font-size: 15px">{{ $post['created_at'] }}</h4>
                    </div>
                    <div>
                        @if(auth()->user() && auth()->user()->id !== $post->user->id)
                        <form action="{{ route('follow.toggle', $post->user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" style="background-color: #591f614d; 
                        border:1px solid rgb(23, 11, 29);
                        color: white;
                        padding: 3px 30px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin-left: 10px;
                        cursor: pointer;">
                                @if(auth()->user()->isFollowing($post->user))
                                আনফলো
                                @else
                                ফলো
                                @endif
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <h3><strong>{{ $post['title'] }}</strong></h3>

                @if(auth()->check())
                        <form id="bookmarkForm{{ $post->id }}" action="{{ route('posts.bookmark.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit" id="bookmarkButton{{ $post->id }}" style="background-color: #591f614d; 
                                border: 1px solid rgb(23, 11, 29);
                                color: white;
                                padding: 5px 32px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                margin: 1px 1px;
                                cursor: pointer;">📑
                            </button>
                        </form>
                    @endif

                <p>{{ $post['body'] }}</p>
                {{-- <h4 style="font-size: 15px"> Post created at: </h4> --}}

                @if($post->reported)
                                <button type="button" class="btn btn-danger">রিপোর্ট করা হয়েছে</button>
                                @else
                                <form action="{{ route('post.report', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure you want to report this post?')" class="btn btn-danger">রিপোর্ট করুন</button>
                                </form>
                                @endif

                            </form>
                
                <div>
                    
                    <p><strong style="font-size: 14px;">লাইক সংখ্যা: {{ $post->likes }}</strong></p>

                    <form action="/like/{{ $post->id }}" method="POST">
                        @csrf
                    <button style="background-color: #591f614d; 
                    border: 1px solid rgb(23, 11, 29);
                    color: white;
                    padding: 5px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 1px 1px;
                    cursor: pointer;">🤍
                </button>
                    </form>
                </div>
                <div style="display: inline-block;">
                    <form action="{{ route('comment.store') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="body" placeholder="কমেন্ট লিখুন.." style="font-size: 12px;"></textarea><br>
                        <button type="submit" style="background-color: #591f614d; 
                                border: 1px solid rgb(23, 11, 29);
                                color: white;
                                padding: 5px 32px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 15px;
                                cursor: pointer;">কমেন্ট
                        </button>
                    </form>
                </a>


                    
                    @if($post->comments->count() > 0)
                    <strong style="font-size: 18px;">সব কমেন্ট ({{ $post->comments->count() }})</strong>
                    {{-- <h2> সব কমেন্ট ({{ $post->comments->count() }})</h2> --}}
                    <br>
                    @foreach($post->comments as $comment)
                        <div style="background-color: #d2b7e4; padding: 5px; margin-top: 5px;">
                            <div>
                            
                            @if($comment->user)
                                <b>{{ $comment->user->name }}</b>
                            @else
                                <b>{{$post->user->name}}</b>
                            @endif
                            {{ $comment->body }}
                           
                            <form action="{{ route('comment.delete', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #591f614d; 
                                        border: 1px solid rgb(23, 11, 29);
                                        color: white;
                                        padding: 3px 10px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        cursor: pointer;">কমেন্ট মুছে ফেলুন
                                </button>
                                <p>
                            </form>

                            <form action="{{ route('comments.reply') }}" method="POST">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <textarea name="body" placeholder="এখানে রিপ্লাই লিখুন.."style="font-size: 12px;"></textarea><p>
                                <button type="submit" style="background-color: #591f614d; 
                                        border: 1px solid rgb(23, 11, 29);
                                        color: white;
                                        padding: 3px 10px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        cursor: pointer;">রিপ্লাই করুন
                                </button>
                            </form>
                            <div>
                            @foreach($comment->replies as $reply)
                            {{-- <div> --}}
                                
                                @if($reply->user)
                                <b>{{ $reply->user->name }}</b>
                                @endif
                                {{ $reply->body }}

                                <form action="{{ route('reply.delete', $reply) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #591f614d; 
                                            border: 1px solid rgb(23, 11, 29);
                                            color: white;
                                            padding: 3px 10px;
                                            text-align: center;
                                            text-decoration: none;
                                            display: inline-block;
                                            font-size: 16px;
                                            cursor: pointer;">রিপ্লাই মুছে ফেলুন
                                    </button>
                                    <p>
                                </form>
                            
                            @endforeach
                            </div>


                            

                        </div>
                    </div>
                    @endforeach
                    @else
                        <p>এখনও কোনো কমেন্ট করা হয়নি।</p>
                    @endif
    
                </div>
                <p><a href="/edit-post/{{ $post->id }}"><button style="background-color: #591f614d; 
                    border:1px solid rgb(23, 11, 29);
                    color: white;
                    padding: 5px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 2px 1px;
                    cursor: pointer;">পরিবর্তন করুন</button>
                </a>
                @if(auth()->check() && auth()->user()->id === $post->user->id)
                <form action="/delete-post/{{ $post->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure you want to delete this post?')" style="background-color: #591f614d; 
                        border: 1px solid rgb(23, 11, 29);
                        color: white;
                        padding: 5px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin: 2px 1px;
                        cursor: pointer;">মুছে ফেলুন
                    </button>
                </p>
                </form>
                @endif
                @if(auth()->check() && auth()->user()->id !== $post->user_id)
                    <form action="{{ route('posts.markSolved', $post) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="checkbox" name="solved" {{ $post->solved ? 'checked' : '' }}>
                        
                        <button type="submit">{{ $post->solved ? 'পোস্ট সমাধান করা হয়নি' : 'পোস্ট সমাধান করা হয়েছে' }}</button>
                    </form>
@endif
            
            </div> 
            @endforeach
        </div>
    </div>
</div>

<script>
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    document.getElementById('myProfileButton').addEventListener('click', function(event) {
        if (!isLoggedIn) {
            var confirmLogin = confirm('You are not logged in. Do you want to log in?');
            if (!confirmLogin) {
                event.preventDefault(); // Prevent the default action (following the link)
            } else {
                window.location.href = '{{ route("login") }}'; // Redirect to the login page
            }
        }
    });
</script>

@endsection