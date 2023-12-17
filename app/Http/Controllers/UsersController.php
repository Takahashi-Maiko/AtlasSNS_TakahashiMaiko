<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }

    // 新規登録メソッド
    //     public function profile(){
    //     return view('users.profile');
    // }

    // ログインメソッド
        public function users(){
        return view('users.profile');
    }


    //↓↓フォロー機能の実装
    //ログインしているユーザーがフォローしている人数の取得(フォロー数)
    // public function follow(){
    //     $follow = Follows::get();   //followsテーブルからレコードを取得
    // }

    // //ログインしているユーザーをフォローしている人数の取得(フォロワー数)
    // public function follower(){
    //      $follower = Follows::get();   //followsテーブルからレコードを取得
    // }

}
