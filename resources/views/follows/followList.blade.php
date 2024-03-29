@extends('layouts.login')

@section('content')

<!-- ↓↓タイトル -->
<h2>Follow List</h2>

  @foreach($follows as $follow)

<!-- ↓↓フォローしているユーザーのアイコン一覧の表示 -->
<div class="follow-icon"><img src="{{asset('storage/images/'.$follow->images)}}" alt="フォローアイコン"></div>

  @endforeach


  @foreach($post as $posts)
  <div class="follow-content">
    <ul>
      <!-- postsテーブルのとusersテーブルのリレーションを行う(1(users)対多(posts)の関係) -->
      <!-- $posts->user->usernameのuserはリレーションの記述のuserメソッドを使っている。 -->
      <li class="icon"><img class="icon-img" src="{{asset('storage/images/'.$posts->user->images)}}" alt="フォローアイコン"></li>
      <li class="username">{{ $posts->user->username }}</li>
      <li class="post">{{ $posts->post}}</li>
      <li class="create_at">{{ $posts->created_at }}</li>
    </ul>
  </div>
  @endforeach



@endsection
