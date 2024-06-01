<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Follow;
use App\Post;

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
        $is_following = $follower->isFollowed($user->id);
        if($is_followed){
        //フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
    }
    }

    // プロフィール編集の実装   2024/3/16
    public function profileUpdate(Request $request){

        $validator = Validator::make($request->all(),[   //バリデーションルール
            'username'  => 'required|min:2|max:12',
            'mail' => ['required', 'min:5', 'max:40', 'email', Rule::unique('users')->ignore(Auth::id())],
            'password' => 'required|confirmed|min:8|max:20|alpha_num',   //confirmedでpassword_confirmationとパスワードが一致するか確認する。
            'password_confirmation' => 'required|min:8|max:20|alpha_num',
            'bio' => 'max:150',
            'iconimage' => 'required|file|image|mimes:png,jpeg,bmp,gif,svg',
        ]);
        // ↑↑DBに登録済みのメールアドレスはバリデーションで引っかかるように設定したい。
        // unique('users')にするとusersテーブルに登録されているメールアドレスすべて＝ログインしているユーザーのメールアドレスも引っかかってしまう。
        // ignoreメソッドを使うことで、ログインしているユーザーのID以外をバリデーションで引っかかるように設定する。
        // 'iconimage'のfile(ファイルアップロード形式)、image(画像)、mimes(png,jpeg,bmp,gif,svgのみ許可)
        // dd($validator);

        $user = Auth::user();   //ログインユーザーを取得する

        // ↓↓画像の登録 2024/3/16
        // $image = $request->file('iconimage')->store('storage/images');
        // $img=$request->iconimage->storeAs('storage');   //formで設置したname属性のiconimage
        // dd($img);
        if ($request->hasFile('iconimage')) {
            $imageName = $request->file('iconimage')->getClientOriginalName();

            $image = $request->file('iconimage')->storeAs('public/images',$imageName);
            // ↑↑<input type="file" name="iconimage" />から渡される値を受け取るにはfile()関数を使う。
            // ↑↑保存するためにstore('storage/images')を記述。※store('ディレクトリ/ディスク')
        } else {
            $imageName = $user->images; //ない場合デフォルトの値を設定する
        }
        // dd($imageName);


        $validator ->validate();
        $user->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => Hash::make($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => $imageName,
        ]);

        return redirect('/top');
    }

    // ↓↓他ユーザーのアイコンからプロフィール表示 2024/3/29
    public function otherProfile($id){
        $users = User::where('id',$id)->first();   //Userモデルからユーザーのidを取得する。
        $id = User::where('id',$id)->first();
        // dd($id);

        // $post = Post::with('user')->whereIn('user_id', Auth::user()->followers()->pluck('following_id'))->latest()->get();
        $post = Post::where('user_id', $users->id) ->orderBy('created_at', 'desc')->get();
        // Postモデルからアイコンをクリックしたユーザー($users)の投稿を新着順に取得する
        // dd($post);
        // dump($posts);

        return view('users.otherprofile',[
            'id' => $id, 'users' => $users, 'post' => $post
        ]);

    }


}
