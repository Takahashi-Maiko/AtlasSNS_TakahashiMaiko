@extends('layouts.login')

@section('content')

<!-- プロフィール編集ページ   2024/3/14 -->

<div class="edit-container">
  <div class="update">
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
         <div class="update-box">
           <!-- ↓↓ユーザー名 -->
           <div class="edit-icon"><img src="{{asset('storage/images/'.Auth::user()->images)}}" alt=""></div>
           <div class="update-area">
           <div class="update-block">
             <label for="name">ユーザー名</label>
             <input type="text" name="username" value="{{ Auth::user()->username }}">
              <!-- ↑↑inputタグで{{ Auth::user()->username }}(ログインユーザー)の名前を取得し初期値に設定する。 -->
            </div>
           <!-- ↓↓メールアドレス -->
       <div class="update-block">
          <label for="mail">メールアドレス</label>
          <input type="email" name="mail" value="{{ Auth::user()->mail }}">
          <!-- ↑↑inputタグで{{ Auth::user()->mail }}(ログインユーザー)のメールアドレスを取得し初期値に設定する。 -->
       </div>
           <!-- ↓↓パスワード -->
       <div class="update-block">
          <label for="pass">パスワード</label>
          <input type="password" name="password" value="">
          <!-- ↑↑パスワードは初期値設定無し。input要素のtype属性に"password"を指定することで伏字になるように設定する。 -->
          <!-- また、label要素を使ってパスワード入力欄にラベルを付けることができる。 -->
       </div>
          <!-- ↓↓パスワード確認用 -->
       <div class="update-block">
          <label for="pass-confirmation">パスワード確認</label>
          <input type="password" name="password_confirmation" value="">
          <!-- ↑↑パスワードは初期値設定無し。input要素のtype属性に"password"を指定することで伏字になるように設定する。 -->
          <!-- また、label要素を使ってパスワード入力欄にラベルを付けることができる。 -->
       </div>
           <!-- 自己紹介文(任意) -->
       <div class="update-block">
          <label for="name">自己紹介</label>
          <input type="text" name="bio" value="{{ Auth::user()->bio }}">
       </div>
           <!-- アイコン画像アップロード(任意) -->
       <div class="update-block">
          <label for="icon">アイコン画像</label>
          <input type="file" name="iconimage"  class="input-file" accept='image/png, image/jpeg, image/bmp, image/gif, image/svg'>
          <!-- ↑↑<input type="file">でファイルのアップロードボタンを設置する。 -->
          <!-- ↑↑accept属性を指定することでアップロード出来るものを画像に限定できる。 -->
       </div>
            <!-- 更新ボタン(更新ボタンを押したら入力された内容を保存しTOPページへ推移する。) -->
       <div class="update-button">
         <input type="submit" class="update-btn" value="更新">
       </div>

       </div>
       </div>
      </div>

   </Form>
  </div>
</div>



@endsection
