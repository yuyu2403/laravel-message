<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/* Coach モデルを読み込み */
use App\Models\Coach;

class CoachController extends Controller
{
    //
    public function add_coach()
    {
        /* resources/views/MessageBoard/index.blade.php を呼び出す */
        return view('add_coach');
    }
    public function confirm_coach(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:100'],

        ]);
        if ($request->has('back')) {
            return redirect('/coach/add')->withInput();
        }
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_coach = new Coach();

            /* リクエストで渡された値を設定する */
            $new_coach->name = $request->name;
            /* データベースに保存 */
            $new_coach->save();

            /* 完了画面を表示する */
            return redirect('/sc_complete');
        }
        return view('/confirm_coach', compact('request'));
    }
    // public function list()
    // {
    //     /* お問い合わせのレコードをすべて取得 */
    //     $contacts = Contact::all();
    //     return view('MessageBoard.list', compact('contacts'));
    // }
    public function edit($coach_id)
    {
        /* URLに含まれるidの値で、編集する対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $coach = Coach::findOrFail($coach_id);



        /* $team と $all_coaches をview ファイルに渡す */
        return view('edit_coach', compact('coach'));
    }
    public function update(Request $request, $coach_id)
    {
        /* URLに含まれるidの値て、更新対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $coach = Coach::findOrFail($coach_id);

        /* 監督名の値を更新する */
        $coach->name = $request->input('name');


        /* Teamモデルの変更をデータベースに反映する */
        $coach->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/team');
    }
}
