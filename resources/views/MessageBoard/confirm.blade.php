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
  <h1>resources/views/MessageBoard/confirm.badede.php</h1>
<p>投稿内容内容確認</p>
<ul>
    <li>
        投稿者：
        <p>{{$request->name}}</p>
    </li>
    <li>
        投稿者の連絡先：
        <p>{{$request->tel}}</p>
    </li>
    <li>
        伝言の宛先：
        <p>{{$request->address}}</p>
    </li>
    <li>
        要件・詳細：
        <p>{{$request->point}}</p>
    </li>
</ul>

<form action="" method="post">
<input type="hidden" name="name" value="{{$request->name}}">
<input type="hidden" name="tel" value="{{$request->tel}}">
<input type="hidden" name="address" value="{{$request->address}}">
<input type="hidden" name="point" value="{{$request->point}}">
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
