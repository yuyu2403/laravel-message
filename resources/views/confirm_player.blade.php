<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>
<p>新選手確認</p>
<ul>
    <li>
        選手：
        <p>{{$request->name}}</p>
    </li>

</ul>

<form action="" method="post">
<input type="hidden" name="name" value="{{$request->name}}">

<div>
<button class="btn btn-primary" type="submit" name="back" >
   <i class="fa-solid fa-caret-left"></i>戻る</button>

</div>
<div>
      <button class="btn btn-primary" type="submit" name="send">
            送信
            <i class="fa-solid fa-caret-right"></i>
        </button>
</div>
@csrf
</form>
</body>
</html>
