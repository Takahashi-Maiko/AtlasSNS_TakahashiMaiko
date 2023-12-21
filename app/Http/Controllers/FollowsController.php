<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Users;
// use App\Posts;
// use App\Follow;

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




        return view('follows.followerList',[
            'posts' => $posts,
            'follows' => $follows

        ]);
    }
}
