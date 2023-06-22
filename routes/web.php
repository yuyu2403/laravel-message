<?php

use App\Http\Controllers\MessageBoard;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Coach;
use App\Models\Team;
use App\Models\Player;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\PositionController;

/* Storage ファサードを読み込み */
use Illuminate\Support\Facades\Storage;

/* 画像アップロード用のコントローラを読み込み */
use App\Http\Controllers\UploadImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/MessageBoard', [MessageBoard::class, 'index']);

Route::prefix('MessageBoard')->group(
    function () {
        Route::post('/confirm', [MessageBoard::class, 'confirm']);

        Route::get('/list', [MessageBoard::class, 'list']);
        Route::post('/delete/{id}', [MessageBoard::class, 'delete']);
    }
);

Route::get('/MessageBoard/complete', function () {
    return view('MessageBoard.complete');
});
Route::get('/MessageBoard/edit/{id}', [MessageBoard::class, 'edit']);
Route::post('/MessageBoard/edit/{id}', [MessageBoard::class, 'update']);


/* ファイルの末尾に、以下を追記する */
/* Coachのデータを一覧表示する
 * (表示したいだけなので、Controllerを作らずルータ内で処理する)
 */
Route::get('/coach', function () {
    /* Coach モデルを通じて、coaches テーブルの内容をすべて取得 */
    $all_coaches = Coach::all();
    foreach ($all_coaches as $coach) {
        /* $coach->teamで、関連付けされたteams テーブルのレコードの内容を取得できる */
        print("<p>監督名： {$coach->name} (担当チーム名： {$coach->team->name})</p>");
    }
})->name('coach');

/* Teamのデータを一覧表示する
 * (表示したいだけなので、Controllerを作らずルータ内で処理する)
 */
Route::get('/team', function () {
    //     $list = <<<list
    // <div>
    //   <form action="/team" method="GET">
    //     <input type="text" name="keyword" value="{{ $keyword }}">
    //     <input type="submit" value="検索">
    //   </form>
    // </div>
    // list;
    //     print $list;
    /* Team モデルを通じて、teams テーブルのデータをすべて取得 */
    $all_teams = Team::all();
    foreach ($all_teams as $team) {
        /* nullの場合があるので、ifでチェック */
        if ($team->coach != null) {
            $coach = $team->coach->name;
        } else {
            $coach = '';
        }
        print("<h2>チーム名： {$team->name} (監督：{$coach}) </h2>");
        print("<p>所属プレイヤー</p>");
        print('<ul>');
        /* $team->playersで、関連付けされたteams テーブルのレコードの内容を取得できる
             * Team モデルとPlayer モデルのリレーションは一対多(hasMany)
             * 複数データが取得されるため、foreachでループしてひとつずつ処理する
             */
        foreach ($team->players as $player) {
            print("<li>{$player->name}</li>");
        }
        print('</ul>');
    }

    print('<a href="/coach/add">監督入力画面へ戻る</a><br>');
    print('<a href="/player/add">選手入力画面へ戻る</a><br>');
    print('<a href="/team/add">チーム入力画面へ戻る</a><br>');
    print('<a href="/position/add">ポジション入力画面へ戻る</a><br>');
    print('<a href="/player">選手一覧へ</a><br>');
});

Route::get(
    'player',

    function () {




        /* Player モデルを通じて、players テーブルのデータをすべて取得 */
        $all_players = Player::all();
        foreach ($all_players as $player) {
            /* null の場合があるので、if でチェック */
            if ($player->team != null) {
                $team = $player->team->name;
            } else {
                $team = '';
            }
            print("<h2>プレイヤー名： {$player->name} (所属チーム: {$team})</h2>");
            print("<p>得意ポジション</p>");
            print('<ul>');
            /* $player->positionsで、関連付けされたpositions テーブルのレコードの内容を取得できる
            * Player モデルとPosition モデルのリレーションは多対多(belongsToMany)
            * 複数データが取得されるため、foreachでループしてひとつずつ処理する
            */
            foreach ($player->positions as $position) {
                print("<li>{$position->name}</li>");
            }
            print('</ul>');
        }
        print('<a href="/coach/add">監督入力画面へ戻る</a><br>');
        print('<a href="/player/add">選手入力画面へ戻る</a><br>');
        print('<a href="/team/add">チーム入力画面へ戻る</a><br>');
        print('<a href="/position/add">ポジション入力画面へ戻る</a><br>');
        print('<a href="/team">チーム一覧へ</a><br>');
    }
);
Route::get('/team/edit/{id}', [TeamController::class, 'edit'], function () {
    return view('users_only');
})->middleware('auth');
// Route::get('/team/edit/{id}', [TeamController::class, 'edit']);
Route::post('/team/edit/{id}', [TeamController::class, 'update']);
Route::get('/player/edit/{id}', [PlayerController::class, 'edit']);
Route::post('/player/edit/{id}', [PlayerController::class, 'update']);
Route::get('/coach/edit/{id}', [CoachController::class, 'edit']);
Route::post('/coach/edit/{id}', [CoachController::class, 'update']);
Route::get('/position/edit/{id}', [PositionController::class, 'edit']);
Route::post('/position/edit/{id}', [PositionController::class, 'update']);

Route::get('/coach/add', [CoachController::class, 'add_coach']);
Route::get('/team/add', [TeamController::class, 'add_team']);
Route::get('/player/add', [PlayerController::class, 'add_player']);
Route::get('/position/add', [PositionController::class, 'add_position']);

Route::post('/coach/confirm', [CoachController::class, 'confirm_coach']);
Route::post('/team/confirm', [TeamController::class, 'confirm_team']);
Route::post('/player/confirm', [PlayerController::class, 'confirm_player']);
Route::post('/position/confirm', [PositionController::class, 'confirm_position']);
Route::get('/sc_complete', function () {
    return view('sc_complete');
});


/* Storage ファサードを使ってファイルの操作をしてみる */
Route::get('storage_test', function () {
    /* タイムスタンプを含めたテキストファイル名を作成 */
    $filename = time() . '.txt';
    /* テキストファイルの内容を作成 */
    $content = "ファイル名: {$filename}";

    /* Storage::put(<ファイルパス>, <内容>) で、ファイルを作成
     * ファイル名だけ記載した場合は、操作対象のdisk の直下に作成される
     */
    Storage::put($filename, $content);

    /* Storage::files(ファイルパス) で、ファイルの一覧を取得 */
    $files = Storage::files();
    dump($files);
});
Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('upload_form', function () {
            return view('upload_form');
        });



        /* POST 送信された画像を受け取って保存するルーティング */
        Route::post('upload_form', [UploadImageController::class, 'upload']);

        /* アップロードされた画像の一覧を表示するルーティング */
        Route::get('upload_images', [UploadImageController::class, 'index']);
    }
);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* ログイン中のみアクセスできるルーティングのサンプル */
Route::get('/users_only', function () {
    return view('users_only');
})->middleware('auth'); /* auth ミドルウェアが認証状態を判定してくれる */

/* 仮登録状態のユーザーに、メールのリンクをクリックする案内を表示する画面のルーティング */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


require __DIR__ . '/auth.php';
