<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Player モデルを読み込み */
use App\Models\Player;

/* Coach モデルを読み込み */
use App\Models\Position;

class PositionController extends Controller
{
    //
    public function add_position()
    {
        /* resources/views/MessageBoard/index.blade.php を呼び出す */
        return view('add_position');
    }
    public function confirm_position(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:100'],

        ]);
        if ($request->has('back')) {
            return redirect('/position/add')->withInput();
        }
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_position = new Position();

            /* リクエストで渡された値を設定する */
            $new_position->name = $request->name;
            /* データベースに保存 */
            $new_position->save();

            /* 完了画面を表示する */
            return redirect('/sc_complete');
        }
        return view('/confirm_coach', compact('request'));
    }
    public function edit($position_id)
    {
        /* URLに含まれるidの値で、編集する対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $position = Position::findOrFail($position_id);

        $all_players = Player::all();

        /* $team と $all_coaches をview ファイルに渡す */
        return view('edit_position', compact('position', "all_players"));
    }
    public function update(Request $request, $position_id)
    {
        /* URLに含まれるidの値て、更新対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $position = Position::findOrFail($position_id);

        /* 監督名の値を更新する */
        $position->name = $request->input('name');


        $position->players()->sync($request->players);
        /* Teamモデルの変更をデータベースに反映する */
        $position->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/player');
    }
}
