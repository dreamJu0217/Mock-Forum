<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Account</title>

<body>
    <h1>অ্যাকাউন্ট মুছে ফেলার নিশ্চিতকরণ</h1>
    <p>আপনি কি নিশ্চিত যে আপনি আপনার অ্যাকাউন্ট মুছে ফেলতে চান?</p>
    <form action="/confirm-delete-account/{{$user->id}}" method="POST">
        
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
            cursor: pointer;">হ্যাঁ, আমার অ্যাকাউন্ট মুছে ফেলুন</button>
    <a href="{{ url('/') }}"><button style="background-color: #591f614d; 
        border: 1px solid rgb(23, 11, 29);
        color: white;
        padding: 5px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 2px 1px;
        cursor: pointer;">বাতিল</button></a>
</body>
</html>
