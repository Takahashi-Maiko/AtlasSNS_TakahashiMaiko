<!-- アイコンをクリックしたらユーザーのプロフィールが表示されるページ -->

@extends('layouts.login')

@section('content')

<div class="otherprofile-content">
  <div class="otherprofile-box">
  <!-- プロフィールの表示させたい(アイコン、名前、自己紹介文) -->
      <ul>
      <div class="otheruser-icon">
        <li class="user-icon"><img class="usericon-img" src="{{asset('storage/images/'.$id->images)}}" alt="ユーザーアイコン"></li></div>
        <li class="username">name   {{ $id->username }}</li>
        <li class="bio">bio   {{ $id->bio }}</li>
      </ul>
   </div>

    <!-- ↓↓クリックしたユーザーの投稿を表示させたい -->
    <div class="otheruser-posts">

      <ul>
        <li class="user-icon"><img class="usericon-img" src="{{asset('storage/images/'.$id->images)}}" alt="ユーザーアイコン"></li></div>
        <li class="username">{{ $id->username }}</li>
        <li class="post">{{ $id->post }}</li>
      </ul>

</div>



@endsection
