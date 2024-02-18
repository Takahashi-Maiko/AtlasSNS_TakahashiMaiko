<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class PostsController extends Controller
{
    //投稿の表示
    public function index(){
        // $post = Post::latest()->first();   //Postテーブルに保存されたツイートを新着順で取得。get()はデータベースから全てを取得する。
        $post = Post::orderBy('create_at','desc')->get();   //データベースから全データを新着順で取り出す。
        $user_id = auth()->user();
        $username = Auth::user()->username;
        // return view('posts.index',compact('post'),[  //compact('post')で$postをビューに送る
            return view('posts.index')->with(['post' => $post]);   //取り出したデータをビューに$postとして渡す。

    }

    //投稿の登録機能
    public function post(Request $request)
    {
        $validator = $request->validate([   //バリデーションの設定：入力必須・1～150文字以内
            'newPost' => ['required','string','max:150'],   //入力必須・文字であること・150文字以内   newPostはname属性
        ]);
        $post = $request->input('newpost');
        Post::create([   //Postテーブルに入れる
            'user_id' => Auth::user()->id,   //Auth::user()はusersテーブルのカラムからログインしているユーザーのidを取得(ツイートしたユーザー)
            'post' => $request->newPost,   //つぶやきの内容
        ]);
        return redirect('/top');
        // return back();
    }
}
