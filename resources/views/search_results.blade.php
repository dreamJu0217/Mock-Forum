@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <h2><strong>অনুসন্ধান ফলাফল</strong></h2>
            @if($posts->isEmpty())
                <p style="font-size: 25px;">অনুসন্ধান ফলাফল পাওয়া যায়নি</p>
            @else
                @foreach($posts as $post)
                    {{-- Check if the user who created the post is not blocked --}}
                    @if(!auth()->check() || !auth()->user()->isBlocking($post->user))
                        <div>
                            <div style="background-color: rgb(185, 168, 214); padding: 10px; margin: 10px;font-size: 20px;">
                                <h3><strong>{{$post['title']}} </strong></h3>
                                <h3>{{$post->user->name}}</h3>
                                <p>{{$post['body']}}</p>
                                <p><a href="/edit-post/{{$post->id}}"><button style="background-color: #591f614d; 
                                    border:1px solid rgb(23, 11, 29);
                                    color: white;
                                    padding: 5px 32px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin: 2px 1px;
                                    cursor: pointer;">পরিবর্তন করুন</button>
                                </a></p>
                                <form action="/delete-post/{{$post->id}}" method="POST">
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
                                 cursor: pointer;">মুছে ফেলুন
                                 </button>
                                </form>
                            </div> 
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection