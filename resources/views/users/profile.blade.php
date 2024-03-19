@extends('layouts.login')

@section('content')

<!-- プロフィール編集ページ   2024/3/14 -->

<div class="container">
  <div class="update">
      <div class="user-icon"><img src="{{asset('storage/'.Auth::user()->images)}}" alt=""></div>
   <Form method="POST" action="{{ route('users.profileUpdate') }}" enctype="multipart/form-data">
      <!-- formタグにenctype="multipart/form-data"属性を用意する。ファイルアップロードをするためにはこれを書く必要がある。 -->
     @csrf

      <!-- ↓↓バリデーションのif文でエラーが無い場合には表示しないように設定。 -->
     @if($errors->first('post'))
     @endif

      <!-- バリデーションのエラー表示 -->
     @foreach ($errors->all() as $error)
     <li>{{$error}}</li>
     @endforeach

      <div class="update-form">
           <!-- ↓↓ユーザー名 -->
       <div class="update-block">
          <label for="name">user name</label>
          <input type="text" name="username" value="{{ Auth::user()->username }}">
          <!-- ↑↑inputタグで{{ Auth::user()->username }}(ログインユーザー)の名前を取得し初期値に設定する。 -->
       </div>
           <!-- ↓↓メールアドレス -->
       <div class="update-block">
          <label for="mail">mail address</label>
          <input type="email" name="mail" value="{{ Auth::user()->mail }}">
          <!-- ↑↑inputタグで{{ Auth::user()->mail }}(ログインユーザー)のメールアドレスを取得し初期値に設定する。 -->
       </div>
           <!-- ↓↓パスワード -->
       <div class="update-block">
          <label for="pass">password</label>
          <input type="password" name="password" value="">
          <!-- ↑↑パスワードは初期値設定無し。input要素のtype属性に"password"を指定することで伏字になるように設定する。 -->
          <!-- また、label要素を使ってパスワード入力欄にラベルを付けることができる。 -->
       </div>
          <!-- ↓↓パスワード確認用 -->
       <div class="update-block">
          <label for="pass-confirmation">password confirm</label>
          <input type="password" name="password-confirmation" value="">
          <!-- ↑↑パスワードは初期値設定無し。input要素のtype属性に"password"を指定することで伏字になるように設定する。 -->
          <!-- また、label要素を使ってパスワード入力欄にラベルを付けることができる。 -->
       </div>
           <!-- 自己紹介文(任意) -->
       <div class="update-block">
          <label for="name">bio</label>
          <input type="text" name="bio" value="{{ Auth::user()->bio }}">
       </div>
           <!-- アイコン画像アップロード(任意) -->
       <div class="update-block">
          <label for="icon">icon image</label>
          <input type="file" name="iconimage" value="">
          <!-- ↑↑<input type="file">でファイルのアップロードボタンを設置する。 -->
       </div>
            <!-- 更新ボタン(更新ボタンを押したら入力された内容を保存しTOPページへ推移する。) -->
       <input type="submit" class="update-btn" value="更新">

      </div>

   </Form>
  </div>
</div>



@endsection
