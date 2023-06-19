<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Team モデルを読み込み */
use App\Models\Team;

/* Coach モデルを読み込み */
use App\Models\Coach;

class TeamController extends Controller
{
    //
    public function add_team()
    {
        /* resources/views/MessageBoard/index.blade.php を呼び出す */
        return view('add_team');
    }
    public function confirm_team(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:100'],

        ]);
        if ($request->has('back')) {
            return redirect('/team/add')->withInput();
        }
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_team = new Team();

            /* リクエストで渡された値を設定する */
            $new_team->name = $request->name;
            /* データベースに保存 */
            $new_team->save();

            /* 完了画面を表示する */
            return redirect('/sc_complete');
        }
        return view('/confirm_team', compact('request'));
    }
    public function edit($team_id)
    {
        /* URLに含まれるidの値で、編集する対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $team = Team::findOrFail($team_id);

        /* Team の監督を選択したいので、Coach を一覧表示する必要がある
         * Coach::all() で、登録されているデータを全件取得する
         */
        $all_coaches = Coach::all();

        /* $team と $all_coaches をview ファイルに渡す */
        return view('edit_team', compact('team', 'all_coaches'));
    }
    public function update(Request $request, $team_id)
    {
        /* URLに含まれるidの値て、更新対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $team = Team::findOrFail($team_id);

        /* チーム名の値を更新する */
        $team->name = $request->input('name');

        /* 関連付けするCoachのIdを更新する
         * Team モデルがcoach_idを持っているので、その値を変更する
         */
        $team->coach_id = $request->coach_id;

        /* Teamモデルの変更をデータベースに反映する */
        $team->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/team');
    }
}
