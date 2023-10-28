<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio', 'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    //↓データを取得しないフィールドの指定
    //↓remember_token:ログイン時にログイン状態を保持
    protected $hidden = [
        'password', 'remember_token',
    ];

    //↓リレーション：1対多
    //postテーブルと連結
    //postは多の関係なので、複数形にして「hasMany」で繋ぐ

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function follow()
    {
        //①相手のクラス②中間テーブル③自分のカラム④相手のカラム
        //フォローする時に動く
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    public function follower()
    {
        //フォローされた人について
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    //フォローしているかどうか
    public function isFollowing($id)
    {
        return $this->follow()->where('followed_id', $id)->exists();
    }
}
