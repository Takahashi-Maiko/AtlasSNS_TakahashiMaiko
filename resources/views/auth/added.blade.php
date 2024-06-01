@extends('layouts.logout')

@section('content')

<div id="clear">
  <p>{{ session('username') }}さん</p>
  <p>ようこそ!AtlasSNSへ</p>
  <br>
  <p>ユーザー登録が完了いたしました。</p>
  <p>早速ログインをしてみましょう!</p>

  <input type="submit" class="btn" value="ログイン画面へ">
  <!-- <p class="btn"><a href="/login">ログイン画面へ</a></p> -->
</div>

@endsection
