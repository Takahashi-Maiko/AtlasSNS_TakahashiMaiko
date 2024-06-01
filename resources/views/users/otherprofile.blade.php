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
      @foreach($post as $posts)
    <div class="otheruser-posts">
      <ul>
        <li class="user-icon"><img class="usericon-img" src="{{asset('storage/images/'.$id->images)}}" alt="ユーザーアイコン"></li></div>
        <li class="username">{{ $id->username }}</li>
        <li class="post">{{ $posts->post }}</li>
        <li class="create_at">{{ $posts->created_at }}</li>
      </ul>
      @endforeach


<!-- ↓↓フォローボタンの設置(2024/4/13) -->
<!-- csrfはform毎に記述が必要 -->
@if (auth()->user()->isFollowing($users->id))
<form action="{{ route('unfollow',['id' => $users->id]) }}" method="POST">
   @csrf
   <button type="submit" class="unfollow-btn">フォロー解除</button>
</form>

@else
<form action="{{ route('follow',['id' => $users->id]) }}" method="POST">
   @csrf
  <button type="submit" class="follow-btn">フォローする</button>
</form>

@endif

</div>



@endsection
