<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \App\Post;
use App\User;


class PostsController extends Controller
{
    //投稿の表示
    public function index(){
        // $post = Post::latest()->first();   //Postテーブルに保存されたツイートを新着順で取得。get()はデータベースから全てを取得する。
        // $post = Post::orderBy('created_at','desc')->get();   //データベースから全データを新着順で取り出す(ログインしているユーザーと登録している全てのユーザーの投稿)。

        // ↓↓orwhereを使い複数の条件を付ける。①whereInを使ってユーザーIDとフォローしているユーザーのID、②orwhereを使ってログインしているユーザーのIDに当てはまる投稿を取得する為にorwhereを使用する。
        $post = Post::orderBy('created_at','desc')->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->orwhere('user_id',Auth::id())->latest()->get();
        // dd($post);

        $user_id = Auth::user()->id;
        $username = Auth::user()->username;
        // return view('posts.index',compact('post'),[  //compact('post')で$postをビューに送る
            return view('posts.index')->with(['post' => $post , 'user_id' => $user_id]);   //取り出したデータをビューに$postとして渡す。

    }

    //投稿の登録機能
    public function post(Request $request)
    {
        $validator = $request->validate([   //バリデーションの設定：入力必須・1～150文字以内
            'newPost' => ['required','string','max:150'],   //入力必須・文字であること・150文字以内   newPostはname属性
        ]);
        $post = $request->textarea('newpost');
        Post::create([   //Postテーブルに入れる
            'user_id' => Auth::user()->id,   //Auth::user()はusersテーブルのカラムからログインしているユーザーのidを取得(ツイートしたユーザー)
            'post' => $request->newPost,   //つぶやきの内容
        ]);
        return redirect('/top');
        // return back();
    }

    //投稿の編集機能 2024/2/19
    // public function edit(Post $post){
    //     $user_id = auth()->user();
    //     $posts = $post->postEdit($user_id->id, $post->id);   //編集する投稿をPost.phpのpostEditメソッドに$postを渡してその結果をViewに渡す処理をする。

    //     if (!isset($posts)) {
    //         return redirect('/top');
    //     }

    //     return view('posts.index',[
    //         'user_id' => $user_id,
    //         'posts' => $posts
    //     ]);
    // }

    //編集した投稿内容の更新機能　2024/2/19
    public function postUpdate(Request $request){
        $data = $request->all();
        $validator = $request->validate([
            'text' => ['required', 'string', 'max:150']
        ]);

        // $validator->validate();
        $post=Post::find($data['id']);
        // dd($post);
        $post->postUpdate($data);

        return redirect('/top');
    }

    //投稿の削除機能(Delete) 2024/2/21
    public function delete($id){   //$user_idと$Post.phpに作成したpostDeleteメソッドに渡していく。
        // dd($id);
        // $user = auth()->user();
        // $post->postDelete($user->id, $id);
        Post::where('id',$id)->delete();

        return redirect('/top');
    }

//     public function timeline(){   //フォローしているユーザーの投稿のみ表示させる
//         $post = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('following_id'))->latest()->get();
//         return view('/top')->with([
//             'post' => $post,
//             ]);

// }
}
