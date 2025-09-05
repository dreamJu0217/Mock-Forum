@extends('layouts.app')

@section('content')
<div class="container">
    <h2>বার্তা লিখুন</h2>
    <form action="{{ route('messages.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipient">রেসিপিএন্ট:</label>
            <select name="recipient_id" id="recipient" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="message">বার্তা:</label>
            <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">বার্তা পাঠান</button>
    </form>
</div>
@endsection