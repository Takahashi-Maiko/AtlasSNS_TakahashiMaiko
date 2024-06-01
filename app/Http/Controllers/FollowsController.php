<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){   //フォローリストの表示(ログインユーザーがフォローしている相手)
        // フォローしているユーザーをすべて取得 12/17
        $follows = Auth::user()->follows()->get();
        // dd($follows);

        // //フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');  //pluckを使い複数の'following_id'(ログインユーザーがフォローしているユーザー)を取得する。
        // dd($following_id);

        // // フォローしているユーザーのidを元に投稿内容を取得
        // $posts = Post::with('user')->whereIn('followed_id', $following_id)->get();

        //↓↓Postモデルの中のuser_idが、Auth::user()->follows()->pluck('followed_id')の自分がフォローしている相手のユーザーidを取得して、latest()->get()で最新順に投稿を取得する。   2024/3/13
        $post = Post::with('user')->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        // return view('follows.followList',compact('post',));
        return view('follows.followList',[
            'follows' => $follows, 'post' =>$post
        ]);

    }

    public function followerList(){   //フォロワーリストの表示(ログインユーザーの事をフォローしている人達)
        // フォロワーをすべて取得 12/17
        $followers = Auth::user()->followers()->get();

        //フォローされているユーザーのIDを取得
        $followed_id = Auth::user()->followers()->pluck('following_id');   //pluckを使い複数の'followed_id'(ログインユーザーの事をフォローしているユーザー)を取得する。

        //↓↓Postモデルの中のuser_idが、Auth::user()->follows()->pluck('followed_id')の自分の事をフォローしているユーザーのidを取得して、latest()->get()で最新順に投稿を取得する。  2024/3/13
        $post = Post::with('user')->whereIn('user_id', Auth::user()->followers()->pluck('following_id'))->latest()->get();

        // return view('follows.followerList',compact('post'));
        return view('follows.followerList',[
            'followers' => $followers, 'post' =>$post
        ]);
        // return view('follows.followerList')->with([
        //     'post' => $post,
            // 'followers' => $followers
            // ]);

        // return view('follows.followerList',[
        //     'posts' => $posts,
        //     'follows' => $follows

        // ]);
    }

    public function follow(User $user,$id)   //(2024/1/19)フォローする機能の実装(2024/1/31ｌ完成)
    {
         $user = User::find($id);
        //ログイン中のユーザーを取得
        $follower = auth()->user();
        //↓↓フォローしているかの確認
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            //↓↓フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    public function unfollow(User $user,$id)   //(2024/1/19)フォロー解除機能の実装(2024/1/31完成)
    {
         $user = User::find($id);
        //ログイン中のユーザーを取得
        $follower = auth()->user();
        //  dd($user->id);
        //↓↓フォローしているかの確認
        $is_followed = $follower->isFollowing($user->id);
        if($is_followed){
            //↓↓フォローしていればフォロー解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}
