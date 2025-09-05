<!DOCTYPE html>
<html lang="bn">
<title>editing</title>
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <title>পোস্ট সম্পাদনা করুন</title> --}}
  <style>
    /* Centering styles */
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background-color: rgb(185, 168, 214);
    }

    /* Styling for the form container */
    #form-container {
      width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    input[type="text"],
    textarea {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      background-color: #591f61;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #4a184a;
    }
  </style>
</head>
<body>
  
  <div id="form-container">
    <h1>পোস্ট সম্পাদনা করুন</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
      @csrf
      @method('PUT')
      
      <input type="text" name="title" value="{{$post->title}}" placeholder="পোস্টের শিরোনাম">
      <textarea name="body" placeholder="পোস্টের বিস্তারিত">{{$post->body}}</textarea>
      <button>পরিবর্তন সংরক্ষণ করুন</button>
    </form>
  </div>
</body>
</html>
