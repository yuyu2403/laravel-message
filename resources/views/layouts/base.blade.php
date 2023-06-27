<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <a href="/team">チーム一覧</a><br>
        <a href="/coach">監督一覧</a><br>
        <a href="/player">プレイヤー一覧</a><br>
        <a href="/position">ポジション一覧</a><br>
        <a href="">navi5</a>
    </header>
<main>
    @yield('content')
</main>

</body>
</html>
