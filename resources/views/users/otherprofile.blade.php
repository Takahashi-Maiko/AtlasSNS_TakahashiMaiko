<!-- アイコンをクリックしたらユーザーのプロフィールが表示されるページ -->

@extends('layouts.login')

@section('content')

<div class="otherprofile-content">
  <div class="otherprofile-box">
    <!-- プロフィールの表示させたい(アイコン、名前、自己紹介文) -->
    <div class="otherprofile-area">
      <div class="otheruser-icon">
        <div class="user-icon"><img class="usericon-img" src="{{asset('storage/images/'.$id->images)}}" alt="ユーザーアイコン"></div></div>
          <div class="otherprofile-text">
            <div class="username"> ユーザー名<span class="username-area">{{ $id->username }}</span></div>
            <div class="bio">自己紹介<span class="bio-area"> {{ $id->bio }} </span></div>
          </div>
        </div>

        <!-- ↓↓フォローボタンの設置(2024/4/13) -->
        <!-- csrfはform毎に記述が必要 -->
        <div class="btn-area">
        @if (auth()->user()->isFollowing($users->id))
        <form action="{{ route('unfollow',['id' => $users->id]) }}" method="POST">
          @csrf
          <button type="submit" class="unfollow-button">フォロー解除</button>
        </form>

        @else
        <form action="{{ route('follow',['id' => $users->id]) }}" method="POST">
          @csrf
          <button type="submit" class="follow-button">フォローする</button>
        </form>
        @endif
        </div>

  </div>

    <!-- ↓↓クリックしたユーザーの投稿を表示させたい -->
      @foreach($post as $posts)
      <ul>
        <li class="post-block">
          <div class="icon"><img class="icon-img" src="{{asset('storage/images/'.$id->images)}}" alt="ユーザーアイコン"></div>
         <div class=post-content>
            <div>
              <div class="username">{{ $id->username }}</div>
              <div class="create_at">{{ $posts->created_at }}</div>
            </div>
              <div class="post">{{ $posts->post }}</div>
          </div>
        </li>
      </ul>
      @endforeach

</div>



@endsection
