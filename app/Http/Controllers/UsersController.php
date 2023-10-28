<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //プロフィール
    public function profile()
    {
        return view('users.profile');
    }
    //プロフィールの更新
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        //↓バリデーション↓
        $request->validate([
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users,mail,' . $user->id . 'id',
            'bio' => 'nullable|string|max:150',
            'password' => 'alpha_num|min:8|max:20|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        $user->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'bio' => $request->input('bio')
        ]);
        //↓画像の更新↓
        //getClientOrignalNameでオリジナルの名前が取れる
        //storeAsメソッドを追加して引数に入れた上で、保存場所と変数名を指定する
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $img = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $img);
            //dd($img);
            //usersテーブルのimagesカラムの更新
            $user->update(['images' => $img]);
        } else {
            //空の場合はデフォルトを維持する
            $img = $user->images;
            //元の値を再度保存
            $user->update(['images' => $img]);
        }

        //↓パスワードの更新↓
        //$requestの中にパスワードが送られてきているかつパスワードが入力されていたら更新を行う
        if ($request->has('password')) {
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            } else {
                // パスワードが空の場合は既存のパスワードを保持
                // 更新前のパスワードを取得して、既存のパスワードを再度保存
                $password = $user->password;
                $user->password = $password;
            }
        }
        $user->save();
        return redirect('/top');
    }
    //他ユーザーのプロフィール
    public function otherProfile($id)
    {
        //$users = Auth::user();
        $posts = Post::where('user_id', $id)->get();
        //フォローユーザーのIDを
        $profile = User::where('id', $id)->get();
        //dd($profile);
        return view('users.otherprofile', [
            'profile' => $profile,
            'posts' => $posts
        ]);
    }

    //ユーザー検索
    public function search(Request $request)
    {
        //$users = User::all()は×
        //whereに続くから
        $query = User::query();

        //1つ目の処理：検索フォームで入力された値を受け取る
        $keyword = $request->input('keyword');
        //2つ目の処理：条件分岐
        //①キーワードが入力されたら曖昧検索を実行して、自分以外のユーザーを表示する、かつ入力された値を表示する
        //②キーワードがなければ、自分以外のユーザー一覧表示
        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%')->where('id', '!=', Auth::id())->get();
            $users = $query->get();
            return view('users.search', [
                'users' => $users,
                'keyword' => $keyword
            ]);
        } else {
            $users = User::where('id', '!=', Auth::id())->get();
            return view('users.search', ['users' => $users]);
        }
    }
    //フォロー機能
    public function follow($id)
    {
        //dd($id);
        //follwing_idに入るのがログインユーザーだと定義→フォロークラスを動かす
        //atach：中間テーブルにレコードの追加
        $users = Auth::user();
        $isFollowing = $users->isFollowing($id);
        if (!$isFollowing) {
            $users->follow()->attach($id);
            return back();
        }
    }
    //フォロー解除
    public function unfollow($id)
    {
        $users = Auth::user();
        $isFollowing = $users->isFollowing($id);
        //フォローをしているときは外す
        //detach：レコードの削除
        if ($isFollowing) {
            $users->follow()->detach($id);
            return back();
        }
    }
}
