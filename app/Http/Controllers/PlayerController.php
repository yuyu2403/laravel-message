<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Player モデルを読み込み */
use App\Models\Player;

/* Team モデルを読み込み */
use App\Models\Team;

/* Position モデルを読み込み */
use App\Models\Position;

class PlayerController extends Controller
{
    //
    public function add_player()
    {
        /* resources/views/MessageBoard/index.blade.php を呼び出す */
        return view('add_player');
    }
    public function confirm_player(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:100'],

        ]);
        if ($request->has('back')) {
            return redirect('/player/add')->withInput();
        }
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_player = new Player();

            /* リクエストで渡された値を設定する */
            $new_player->name = $request->name;
            /* データベースに保存 */
            $new_player->save();

            /* 完了画面を表示する */
            return redirect('/sc_complete');
        }
        return view('/confirm_player', compact('request'));
    }
    public function edit($player_id)
    {
        /* URLに含まれるidの値で、編集する対象のPlayer オブジェクトを取得する
         * Player::findOrFail(<player_id>)
         *   ->  idに一致するPlayerのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $player = Player::findOrFail($player_id);

        /* 所属しているチームを選択したいので、Team を一覧表示する必要がある
         * Team::all() で、登録されているデータを全件取得する
         */
        $all_teams = Team::all();

        /* 得意ポジションを選択したいので、Position を一覧表示する必要がある
         * Position::all() で、登録されているデータを全件取得する
         */
        $all_positions = Position::all();

        /* $player と $all_positions, $all_teams をview ファイルに渡す */
        return view('edit_player', compact('player', 'all_positions', 'all_teams'));
    }
    public function update(Request $request, $player_id)
    {
        /* URLに含まれるidの値で、編集する対象のPlayer オブジェクトを取得する
         * Player::findOrFail(<player_id>)
         *   ->  idに一致するPlayerのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $player = Player::findOrFail($player_id);

        /* 選手名の値を更新する */
        $player->name = $request->input('name');


        /* 関連付けするTeamのIdを更新する
         * Player モデルがteam_idを持っているので、その値を変更する
         */
        $player->team_id = $request->team_id;

        /*
         * 関連付けするPosition のデータを更新する
         * リレーションはbelongsToMany なので、中間テーブルのレコードを更新する
         * 今回は、関連付けしたいPosition のidの配列があるので、sync() でまとめて更新する
         */
        $player->positions()->sync($request->positions);

        /* Player モデルの変更をデータベースに反映する */
        $player->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/player');
    }

    public function list(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Player::query();
        if ($request->has('check')) {
            /* Contact モデルのオブジェクトを作成 */
            $id = $request->id;

            $new_player = Player::find($id);
            /* リクエストで渡された値を設定する */

            $new_player->check = $request->check;
            /* データベースに保存 */
            $new_player->save();

            /* 完了画面を表示する */
            return redirect('/player');
        }
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
    }
}
