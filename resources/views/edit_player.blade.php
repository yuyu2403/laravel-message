@extends('layouts.base')
    @section('title')
    選手情報編集
    @endsection
@section('content')
<h1>選手情報編集</h1>

<form action="" method="POST">

    <div>
        <label>
            選手名
            <input type="text" name="name" value="{{ $player->name }}">
        </label>
    </div>

    <div>
        所属チーム
        <!-- {{-- 監督データをラジオボタンで表示し、選択できるようにする --}} -->
        @foreach ($all_teams as $team)
            <input type="radio" name="team_id" value="{{ $team->id }}"

                {{-- 現在、TeamとリレーションがあるCoachのデータの場合、初期状態で選択しておく --}}
                {{-- 監督が設定されていない(teamのcoach_idがnull)もあるので、その判定もする --}}
                @if( $player->team != null && $team->id == $player->team->id)
                    checked="checked"
                @endif
            >
                {{ $team->name }}
        @endforeach
    </div>
得意ポジション
<select name="positions[]"multiple >
    @foreach ($all_positions as $position )
        <option value="{{$position ->id}}"
            @if ($player -> positions != null && $player -> positions -> contains('id',$position->id) )
            selected ="selected"

            @endif
            >
            {{$player->positions}}
            {{$position ->name}}
        </option>
    @endforeach
</select>
    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
@endsection
