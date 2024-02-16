<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [   //追加(2024/2/9) $fillableに設定されている値のみテーブルに保存する事が出来る。
        'id','user_id', 'post','username',
    ];

    //リレーションの定義
    public function posts(){
  return $this->hasMany('App\Post');
}
    public function getPost(Int $post)
    {
        return $this->with('user')->where('id',$post)->first();
    }


}
