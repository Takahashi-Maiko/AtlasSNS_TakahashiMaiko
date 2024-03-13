<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable=[
        'following_id','followed_id'
    ];

    //フォローしているユーザーのIDの人数を取得
    public function getFollowCount($user_id){
        return $this->where('following_id',$user_id)->count();
    }

    //フォローされているユーザーのIDの人数を取得
    public function getFollowerCount($user_id){
        return $this->where('followed_id',$user_id)->count();
    }
}
