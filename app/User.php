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
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //　↓↓(2023.12.17)フォロー機能の実装のリレーション(多対多)
    //多対多のリレーションなのでbelongsToManyをメソッドとして使用。
    //第一引数＝使用するモデル
    //第二引数＝使用するテーブル名
    //第三引数＝リレーションを定義しているモデルの外部キー名
    //第四引数＝結合するモデルの外部キー名

    // フォロー→フォロワーの結合
     public function follows ()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // フォロワー→フォローの結合
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }


    //↓↓フォロー機能実装(2024/1/12)
    //フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    //フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    //フォローしているか
    public function isFollowing(int $user_id)
    {
        // dd($user_id);
        return (boolean) $this->follows()->where('followed_id',$user_id)->first();
    }

    //フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id',$user_id)->first();
    }
}
