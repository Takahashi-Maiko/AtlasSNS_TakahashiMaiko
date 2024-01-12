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


    public function search(Request $request){
        //テーブルからすべてのレコードを取得する。
        // $users = Users::query();

        //ユーザー一覧をページネートで取得(ページネート＝分割表示機能)
        $users = User::paginate(20);

        //キーワードがあった場合(2024/1/7追記)
        // $keyword = $request->input('keyword');
        // if(!empty($keyword)){   //$keyword が空でない場合検索処理を実行する。
        //     $users -> where('username','like',"%{$keyword}%")
        //     ->orwhereHas('username', function ($query) use ($keyword) {
        //         $query->where('username', 'LIKE', "%{$keyword}%");
        //     })->get();

        //追記(2024/1/10)
        $keyword = $request->input('search');   //'search'にはblade.phpのname属性を記述。(name属性で指定したキーが連想配列のキーの役割を持っている)
          if (isset($keyword)) {
        // if($users){   //ユーザー名が入力されてたらの処理
            $users = User::where('username','LIKE',"%$keyword%")->paginate(20);
            //where()でUserモデルを利用してテーブルのnameカラムを取得
        }else{   //ユーザー名が入力されていない場合の処理
        $users = User::paginate(20);
            // $keyword = User::select('*')->paginate(20);
            //ユーザー名が入力されていない場合は全件表示させることにする。
            // $users = '全件表示';
        }


                //viewファイルに変数として渡す
        return view('users.search')->with([
            'users'=>$users,   //検索語にユーザー名を表示させる
            'keyword'=>$keyword,   //検索ワードを表示させる
        ]);

    }

    //↓↓フォロー(2024/1/12)
    public function follow(User $user)
    {
        $follower = auth()->user();
        //↓↓フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
        //↓↓フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
        }
    }

    //フォロー解除(2024/1/12)
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        //↓↓フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
        //フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
    }
    }




    // ユーザー検索の処理の実装
    // public function searchView(Request $request){

    //     //キーワード取得
    //     $keyword = $request->input('keyword');

    //      // クエリビルダ
    //     // $query = User::query();

    //     //キーワードがあった場合
    //     // if(!empty($keyword)){
    //     //     $query -> orwhere('username','like','%' . $keyword . '%')->get();
    //     // }

    //     //全件取得＋ページネーション
    //     $data = $query->orderBy('create_at','desc')->paginate(5);
    //     return view('users.search')->with('data',$data)->with('keyword',$keyword);
    // }


    // ログインメソッド
    //     public function users(){
    //     return view('users.profile');
    // }





}
