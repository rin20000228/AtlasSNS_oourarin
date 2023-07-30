<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    //投稿の表示
    public function index()
    {
        //フォローしているユーザーのidを取得
        $following_id = Auth::user()->follow()->pluck('followed_id');
        //変数postsにpostテーブルから取得した値を入れる
        //ポストフォルダのインデックスbladeを表示する
        //ブレードに変数を渡す定義
        $posts = Post::whereIn('user_id', $following_id)->orWhere('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
        //ログインユーザーのID（フォローしている人の投稿）とフォローしているIDが一致するもの、かつユーザーIDとログインID（ログインユーザー自身の投稿）が一致する投稿を表示する
    }

    //投稿機能
    public function create(Request $request)
    {
        //バリデーション
        $request->validate([
            'post' => 'required|max:150|min:1',
        ]);

        //ログインしているユーザーのidを取得
        $user_id = Auth::id();
        $posts = $request->input('post');
        Post::create([
            'user_id' => $user_id,
            'post' => $posts,
        ]);
        return redirect('/top');
    }
    //投稿の編集(update)
    public function update(Request $request)
    {
        //dd($request);
        $id = $request->input('postId');
        $up_post = $request->input('upPost');
        // 文字数をチェックして150文字を超える場合は更新を行わない
        if (mb_strlen($up_post) <= 150) {
            Post::where('id', $id)->update([
                'post' => $up_post,
            ]);
        } else {
            // 150文字を超える場合はリダイレクトなどを行う
            return redirect('/top');
        }
        return redirect('/top');
    }

    //投稿の削除
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }
}
