@extends('layouts.base')
    @section('title')
    ポジション編集</title>
 @endsection
@section('content')
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
@endsection
