<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>チーム情報編集</h1>

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
</body>
</html>
