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
        //ユーザー一覧をページネートで取得
        $users = User::paginate(20);

        //viewファイルに変数として渡す
        return view('users.search')->with([
            'users'=>$users,
            'search'=>$search,
        ]);
    }

    // ユーザー検索の処理の実装
    public function searchView(Request $request){

        //キーワード取得
        $keyword = $request->input('keyword');

         // クエリビルダ
        $query = User::query();

        //キーワードがあった場合
        if(!empty($keyword)){
            $query -> orwhere('username','like','%' . $keyword . '%')->get();
        }

        //全件取得＋ページネーション
        $data = $query->orderBy('create_at','desc')->paginate(5);
        return view('users.search')->with('data',$data)->with('keyword',$keyword);
    }


    // ログインメソッド
        public function users(){
        return view('users.profile');
    }





}
