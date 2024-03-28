<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [   //追加(2024/2/9) $fillableに設定されている値のみテーブルに保存する事が出来る。
        'id','user_id', 'post','username','create_at',
    ];

    //リレーションの定義
    public function user(){
  return $this->belongsTo('App\User');
    }

    //投稿の編集機能(edit) 2024/2/19
    public function postEdit(Int $user_id, Int $post){   //$user_idと$postの値が一致する投稿を取得する。
        return $this->where('user_id',$user_id)->where('post',$post)->first();
    }

    //編集した投稿内容の更新機能(update) 2024/2/19
    public function postUpdate(Array $data){
        $this->post = $data['text'];
        return $this->save();

    }

    //投稿の削除機能(Delete) 2024/2/21
    // public function postDelete(Int $user_id, Int $post){   //$user_idと$postに一致したツイートを取得し削除する。
    //     return $this->where('user_id',$user_id)->where('id',$post)->delete();

    // }


}
