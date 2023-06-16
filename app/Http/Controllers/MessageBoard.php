<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MessageBoard extends Controller
{
    //
    public function index()
    {
        /* resources/views/MessageBoard/index.blade.php を呼び出す */
        return view('MessageBoard.index');
    }
    public function confirm(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => ['required', 'min:2', 'max:100'],

            'tel'  => ['required'],

            'address'  => ['required'],

            'point'  => ['required']
        ]);
        if ($request->has('back')) {
            return redirect('/MessageBoard')->withInput();
        }
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_contact = new Contact();

            /* リクエストで渡された値を設定する */
            $new_contact->name = $request->name;
            $new_contact->tel = $request->tel;
            $new_contact->address = $request->address;
            $new_contact->point = $request->point;
            /* データベースに保存 */
            $new_contact->save();

            /* 完了画面を表示する */
            return redirect('/MessageBoard/complete');
        }
        return view('MessageBoard.confirm', compact('request'));
    }
    // public function list()
    // {
    //     /* お問い合わせのレコードをすべて取得 */
    //     $contacts = Contact::all();
    //     return view('MessageBoard.list', compact('contacts'));
    // }
    public function list(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Contact::query();
        if ($request->has('check')) {
            /* Contact モデルのオブジェクトを作成 */
            $id = $request->id;

            $new_contact = Contact::find($id);
            /* リクエストで渡された値を設定する */

            $new_contact->check = $request->check;
            /* データベースに保存 */
            $new_contact->save();

            /* 完了画面を表示する */
            return redirect('/MessageBoard/list');
        }
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('tel', 'LIKE', "%{$keyword}%")
                ->orWhere('address', 'LIKE', "%{$keyword}%")
                ->orWhere('point', 'LIKE', "%{$keyword}%");
        }

        $contacts = $query->get();

        return view('MessageBoard.list', compact('contacts', 'keyword'));
    }

    public function delete($id)
    {
        $contact_to_delete = Contact::find($id);
        $contact_to_delete->delete();
        return redirect('/MessageBoard/list');
    }
    public function edit($id)
    {
        $contact = Contact::find($id);

        return view('MessageBoard.edit', compact('contact'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => ['required', 'min:2', 'max:100'],]);
        $this->validate($request, ['tel' => ['required'],]);
        $this->validate($request, ['address' => ['required'],]);
        $this->validate($request, ['point' => ['required'],]);
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->tel = $request->tel;
        $contact->address = $request->address;
        $contact->point = $request->point;
        $contact->save();

        return redirect('/MessageBoard/list');
    }
}
