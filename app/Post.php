<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //↓下記を追加してください
    protected $fillable = [
        'post', 'user_id'
    ];
    //↓リレーション：1対多
    //Post：多、User：1
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
