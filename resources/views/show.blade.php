@extends('layouts.app')

@section('content')
<div class="container">
    <h1><strong>আমার প্রোফাইল</strong></h1><br>
    <p><strong>নাম:</strong> {{ $user->name }}</p>
    <p><strong>ইমেইল:</strong> {{ $user->email }}</p>
    <div class="row" style="background-color: rgb(209, 187, 216); padding: 10px; margin-bottom: 10px;">
        <div class="col-md-4">
            <p style="font-size: 20px;"><strong>পোস্ট সংখ্যা:</strong> {{ $user->posts->count() }}</p>
        </div>
        <div class="col-md-4">
            <p style="font-size: 20px;"><strong>ফলোইং:</strong> {{ $user->following()->count() }}</p>
        </div>
        <div class="col-md-4">
            <p style="font-size: 20px;"><strong>ফলোয়ার:</strong> {{ $user->followers()->count() }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($user->posts->count() > 0)
            <h2><strong>আমার সব পোষ্ট</strong></h2>
            @foreach($user->posts as $post)
            <div style="background-color: rgb(209, 187, 216); padding: 10px; margin-bottom: 10px;">
                <h3><strong>{{ $post->title }}</strong></h3>
                <p style="font-size: 20px;">{{ $post->body }}</p>
                <!-- Add more details as needed -->
            
            </div>
            @endforeach
            @else
                    <h3>কোনো পোষ্ট নেই।<h3>
                @endif

        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if($bookmarks->count() > 0)
                    <h2><strong>আমার বুকমার্ক করা পোষ্ট</strong></h2>        
                    @foreach($bookmarks as $bookmark)
                    <div style="background-color: rgb(209, 187, 216); padding: 10px; margin-bottom: 10px;">
                        
                        <h3><strong>{{ $bookmark->post->title }}</strong></h3>
                        <p style="font-size: 20px;">{{ $bookmark->post->body }}</p>
                    
                        <form action="{{ route('bookmarks.destroy', $bookmark) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button style="background-color: #591f614d; 
                            border: 1px solid rgb(23, 11, 29);
                            color: white;
                            padding: 5px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 2px 1px;
                            cursor: pointer;">বুকমার্ক সরিয়ে ফেলুন 
                        </button>
                        </form>
                    </div>
                @endforeach
                @else
                    <h3>কোনো বুকমার্ক করা পোস্ট নেই।<h3>
                @endif
            </div>
        </div>
        <br>

            <form action="/delete-acc/{{$user->id}}" method="POST">
                
                @csrf
                @method('DELETE')
                <button style="background-color: #591f614d; 
                    border: 1px solid rgb(23, 11, 29);
                    color: white;
                    padding: 5px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 2px 1px;
                    cursor: pointer;">অ্যাকাউন্ট ডিলিট করুন
                </button>
                
            </form>
            <p><a href="/send/"><button style="background-color: #591f614d; 
                border: 1px solid rgb(23, 11, 29);
                color: white;
                padding: 5px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 2px 1px;
                cursor: pointer;">ইমেইল ভেরিফিকেশন
            </button></a></p>
        </div>
    </div>
</div>
@endsection