<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

//↓↓RegisterFormRequestを使用する為の記述
use App\Http\Requests\RegisterFormRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // 新規登録処理
    public function registerView(Request $request){
        if($request->isMethod('post')){

            //入力したデータを取得
            //POSTの場合の処理
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            // セッション機能でのユーザーネームの保存
            $input = $request->session()->put('username', $username);
            return redirect('added')->with('username', $input);
        }
        //GETの場合の処理
        return view('auth.register');

        // $validated = $request->validated();
    }

    //バリデーション機能
    public function register(RegisterFormRequest $request){
        $validated = $request->validated();
        }


    public function added(Request $request){
        return view('auth.added');
    }
}
