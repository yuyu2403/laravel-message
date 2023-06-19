<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>ポジション編集</h1>

<form action="" method="POST">

    <div>
        <label>
           ポジション名
            <input type="text" name="name" value="{{ $position->name }}">
        </label>
    </div>
該当メンバー
<select name="players[]"multiple >
    @foreach ($all_players as $player )
        <option value="{{$player ->id}}"

            @if ($position -> players != null && $position -> players -> contains('id',$player->id) )
            selected ="selected"
            @endif

            >
            {{-- {{$position->players->id}} --}}
            {{-- {{$position->players->contains('id',$player->id)}} --}}
            {{$player ->name}}
        </option>
    @endforeach
</select>

    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
</body>
</html>
