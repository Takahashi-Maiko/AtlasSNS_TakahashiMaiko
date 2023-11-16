<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
