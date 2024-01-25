<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){   //フォローリスト
        // フォローしているユーザーをすべて取得 12/17
        $follows = Auth::user()->follows()->get();


        // //フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');

        // // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('followed_id', $following_id)->get();



        return view('follows.followList', [
        'posts' => $posts,
        'follows' => $follows
        ]);
    }


    public function followerList(){   //フォロワーリスト
        // フォロワーをすべて取得 12/17
        $followers = auth()->user()->followers()->get();

        //フォローされているユーザーのIDを取得
        $following_id = Auth::user()->follows()->pluck('following_id');


        return view('follows.followerList',[
            'posts' => $posts,
            'follows' => $follows

        ]);
    }

    public function follow(User $user)   //(2024/1/19)フォローする機能の実装
    {
        $follower = auth()->user();
        //↓↓フォローしているかの確認
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            //↓↓フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    public function unfollow(User $user)   //(2024/1/19)フォロー解除機能の実装
    {
        $follower = auth()->user();
        //↓↓フォローしているかの確認
        $is_following = $follower->isFollowing($user->id);
        if(is_following){
            //↓↓フォローしていなければフォロー解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}
