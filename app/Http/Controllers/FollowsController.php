<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followList()
    {
        //フォローリスト表示
        $follows = Auth::user()->follow()->get();
        //ログインユーザーがフォローしているユーザーを取得
        $following_id = Auth::user()->follow()->pluck('followed_id');
        //投稿を表示
        $posts = Post::whereIn('user_id', $following_id)->orderBy('created_at', 'desc')->get();
        return view('follows.followList', [
            'posts' => $posts,
            'follows' => $follows
        ]);
    }
    //ログインユーザーをフォローしている人の投稿
    public function followerList()
    {
        //フォロワーリスト表示
        $followers = Auth::user()->follower()->get();
        //dd($followers);
        //follower:多対多のリレーションを定義している場所＝モデル
        $followed_id = Auth::user()->follower()->pluck('following_id');
        //投稿を表示
        $posts = Post::with('user')->whereIn('user_id', $followed_id)->orderBy('created_at', 'desc')->get();
        return view('follows.followerList', [
            'posts' => $posts,
            'followers' => $followers
        ]);
    }
}
