@extends('layouts.base')
    @section('title')
    コーチ情報編集
    @endsection
@section('content')
<h1>コーチ情報編集</h1>

<form action="" method="POST">

    <div>
        <label>
            監督名
            <input type="text" name="name" value="{{ $coach->name }}">
        </label>
    </div>


    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
@endsection

