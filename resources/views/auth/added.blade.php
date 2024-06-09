@extends('layouts.logout')

@section('content')

<div id="clear">
  <p> <span class="login-name">{{ session('username') }}</span> さん</p>
  <p>ようこそ! <span class="atlas"> AtlasSNS</span>へ</p>
  <br>
  <p>ユーザー登録が完了いたしました。</p>
  <p>早速ログインをしてみましょう!</p>

  <!-- <input type="submit" class="btn" value="ログイン画面へ"> -->
  <div class="btn-login">
  <p class="btn"><a href="/login">ログイン画面へ</a></p>
  </div>
</div>

@endsection
