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
    <h1>resources/views/MessageBoard/list.blade.php</h1>
<h2>投稿内容の一覧</h2>

<div>
  <form action="/MessageBoard/list" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <input type="submit" value="検索">
  </form>
</div>
@if ($contacts->count() > 0)
    <table border="1">
        <tr>
            <th>ID</th>
            <th>投稿者</th>
            <th>投稿者の連絡先</th>
            <th>伝言の宛先</th>
            <th>要件・詳細</th>
            <th>投稿時間</th>
            <th>確認</th>
            <th>確認ボタン</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        {{-- @foreach ディレクティブで、1件ずつ処理 --}}
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->tel }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->point }}</td>
                <td>{{ $contact->created_at }}</td>
                <td>{{ $contact->check }}</td>
                <td><form action="/MessageBoard/list" method="get">
                    {{-- <input type="checkbox" name="check" id="check" value="1"{{ $contact->check  == 1 ? 'checked' : ''}}> --}}
                    <input type="hidden" name="id" value="{{$contact->id}}">
                    <input type="submit"  name="check" value="1">
                    <input type="submit"  name="check" value="0">
                    @csrf
                    </form>
                </td>
                <td><a href="/MessageBoard/edit/{{$contact->id}}">編集</a></td>
                <td>
                <form action="/MessageBoard/delete/{{$contact->id}}" method="post">
                    <input type="submit" value="削除" name="delete">
                    @csrf
                </form>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>投稿内容がありません</p>
@endif
</body>
</html>
