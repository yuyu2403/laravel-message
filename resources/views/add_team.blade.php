<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>
    @foreach ($errors->all() as $error)
<li><span class="error">{{$error}}</span></li>
@endforeach
    <h2>チームの登録</h2>
<form action="/team/confirm" method="POST">
    <div>
        <label for="name">チーム名</label>
        <input type="text" name="name" id="name"value="{{old('name')}}">
        @if ($errors -> has('name'))
<span class="error">{{$errors -> first('name')}}</span>
@endif
    </div>

    <div>
        <input type="submit" value="送信">

    </div>
    @csrf
</form>
</body>
<a href="/coach/add">監督入力画面へ戻る</a>
<a href="/player/add">選手入力画面へ戻る</a>

<a href="/position/add">ポジション入力画面へ戻る</a>
<a href="/team">チーム一覧へ</a>
<a href="/player">選手一覧へ</a>
</html>
