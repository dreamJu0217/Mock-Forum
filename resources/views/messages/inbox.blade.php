<!-- resources/views/messages/inbox.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ইনবক্স</h2>
    @foreach($messages as $message)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">ফ্রম: {{ $message->sender->name }}</h5>
                <p class="card-text">বার্তা: {{ $message->message }}</p>
                <p class="card-text">বার্তা পাঠানো হয়েছে: {{ $message->created_at }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection