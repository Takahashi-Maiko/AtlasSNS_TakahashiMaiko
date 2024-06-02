@extends('layouts.login')

@section('content')

<div class="list">
  <h2>フォローリスト</h2>

    <div class="list-container">
  @foreach($follows as $follow)
    <!-- ↓↓フォローしているユーザーのアイコン一覧の表示 -->
    <!-- ↓↓他ユーザーのプロフィールページへの遷移 -->
      <form action="/users/{id}/otherprofile">
        <div class="follow-icon">
          <a href="/users/{{ $follow->id }}/otherprofile">
            <img src="{{asset('storage/images/'.$follow->images)}}" alt="フォローアイコン"></a>
        </div>
      </form>
  @endforeach
    </div>
</div>


  @foreach($post as $posts)
  <ul>
  <li class="post-block">
      <!-- postsテーブルのとusersテーブルのリレーションを行う(1(users)対多(posts)の関係) -->
      <!-- $posts->user->usernameのuserはリレーションの記述のuserメソッドを使っている。 -->
      <div class="icon">
        <!-- ↓↓他ユーザーのプロフィールページへの遷移 -->
        <a href="/users/{{ $follow->id }}/otherprofile">
         <img class="icon-img" src="{{asset('storage/images/'.$posts->user->images)}}" alt="フォローアイコン"></a></div>
       <div class=post-content>
        <div>
         <div class="username">{{ $posts->user->username }}</div>
         <div class="create_at">{{ $posts->created_at }}</div>
        </div>
         <div class="post">{{ $posts->post}}</div>
       </div>
    </ul>
  </li>
  @endforeach



@endsection
