@extends('layouts.login')

@section('content')


<!-- ↓↓タイトル -->
<h2>Follower List</h2>

@foreach($followers as $follower)

<!-- ↓↓自分をフォローしているユーザーのアイコン一覧の表示 -->
<div class="follower-icon"><img src="{{asset('storage/images/'.$follower->images)}}" alt="フォロワーアイコン"></div>

@endforeach

  @foreach($post as $posts)
  <div class="follower-content">
    <ul>
      <!-- postsテーブルのとusersテーブルのリレーションを行う(1(users)対多(posts)の関係) -->
      <!-- $posts->user->usernameのuserはリレーションの記述のuserメソッドを使っている。 -->
      <li class="icon"><img class="icon-img" src="{{asset('storage/images/'.$posts->user->images)}}" alt="ユーザーアイコン"></li>
      <li class="username">{{ $posts->user->username }}</li>
      <li class="post">{{ $posts->post}}</li>
      <li class="create_at">{{ $posts->created_at }}</li>
    </ul>
  </div>
  @endforeach



<!-- {!! Form::open(['url' => '/follower-list']) !!} -->

@endsection
