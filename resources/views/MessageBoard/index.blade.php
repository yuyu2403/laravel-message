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
    <h1>resources/views/MessageBoard/index.badede.php</h1>
    <h2>投稿内容の入力</h2>
<form action="/MessageBoard/confirm" method="POST">
    <div>
        <label for="name">投稿者</label>
        <input type="text" name="name" id="name"value="{{old('name')}}">
        @if ($errors -> has('name'))
<span class="error">{{$errors -> first('name')}}</span>
@endif
    </div>
    <div>
        <label for="tel">投稿者の連絡先</label>
        <input type="text" name="tel" id="tel"value="{{old('tel')}}">
        @if ($errors -> has('tel'))
<span class="error">{{$errors -> first('tel')}}</span>
@endif
    </div>
    <div>
        <label for="address">伝言の宛先</label>
        <input type="text" name="address" id="address"value="{{old('address')}}">
        @if ($errors -> has('address'))
<span class="error">{{$errors -> first('address')}}</span>
@endif
    </div>
    <div>
        <label for="point">要件・詳細</label>
        <input type="text" name="point" id="point" value="{{old('point')}}">
        @if ($errors -> has('point'))
<span class="error">{{$errors -> first('point')}}</span>
@endif
    </div>
    <div>
        <input type="submit" value="送信">

    </div>
    @csrf
</form>
</body>
</html>
