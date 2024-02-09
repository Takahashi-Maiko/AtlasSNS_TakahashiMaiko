<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostsController extends Controller
{
    //投稿の表示
    public function index(){
        $post = Post::latest()->get();   //Postテーブルに保存されたツイートを新着順で取得。get()はデータベースから全てを取得する。
        $user = auth()->user();
        return view('posts.index',compact('post'),[  //compact('post')で$postをビューに送る
            // 'user' => $user
    ]);
    }

    //投稿の登録機能
    public function post(Request $request)
    {
        $validator = $request->validate([   //バリデーションの設定：入力必須・1～150文字以内
            'post' => ['required','string','max:150'],   //入力必須・文字であること・150文字以内
        ]);
        $post = $request->textarea('newpost');
        Posts::create([   //Postテーブルに入れる
            'user_id' => Auth::user()->id,   //ログインしているユーザーの取得(ツイートしたユーザー)
            'post' => $request->post,   //つぶやきの内容
        ]);
        // return redirect('/top');
        return back();
    }
}
