<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <form action="/MessageBoard/edit/{{$contact->id}}" method="post">
    <div>
        <label for="name">投稿者</label>
        <input type="text" name="name" id="name" value="{{old('name',$contact->name)}}">
        @if ($errors->has('name'))
<p class="error">*{{$errors->first('name')}}</p>
        @endif
    </div>
<div>
        <label for="tel">投稿者の連絡先</label>
        <input type="text"  id="tel" name="tel" value="{{old('tel',$contact->tel)}}">
        @if ($errors -> has('tel'))
<p class="error">*{{$errors -> first('tel')}}</p>
@endif
</div>
<div>
        <label for="address">伝言の宛先</label>
        <input type="text"  id="address" name="address" value="{{old('address',$contact->address)}}">
        @if ($errors -> has('address'))
<p class="error">*{{$errors -> first('address')}}</p>
@endif
</div>
<div>
        <label for="point">要件・詳細</label>
        <input type="text"  id="point" name="point" value="{{old('point',$contact->point)}}">
        @if ($errors -> has('point'))
<p class="error">*{{$errors -> first('point')}}</p>
@endif
</div>

<div><input type="submit" value="送信"></div>
@csrf
    </form>
</body>
</html>
