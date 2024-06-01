@extends('layouts.login')

@section('content')


<div class="search-container">
  <form method="GET" action="{{ route('users.search') }}">
    <div class="search-form">
      <input type="search" placeholder="ユーザー名" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <button type="submit" class="button-search"></button>
    </div>
    </form>

    <!-- 検索キーワードの表示 -->
    @if(!empty($keyword))
    <div class="keyword">
      <p>検索ワード:{{$keyword}}</p>
    </div>
    @endif
  </div>

<!-- 保存されているユーザー一覧の表示 -->
<div class="container-list">
  <!-- foreachで$usersから1つずつ$userとして取り出し表示させる -->
  <!-- 自分以外のユーザーを表示 -->
  <ul>
    <li class="user-block">
      @foreach($users as $user)
       @if(!($user->username == Auth::user()->username))
       <div class="user-box">
        <div class="user-area">
         <div class="search-image"><img src="{{asset('storage/images/' .$user->images)}}" alt="ユーザーアイコン"></div>
          <div class="search-name">  {{$user->username}}  </div>
        </div>

             <!-- ↓↓フォローボタンの設置(2024/1/21) -->
             <!-- csrfはform毎に記述が必要 -->
           @if (auth()->user()->isFollowing($user->id))
          <form action="{{ route('unfollow',['id' => $user->id]) }}" method="POST">
           @csrf
            <button type="submit" class="unfollow-btn">フォロー解除</button>
          </form>

          @else
         <form action="{{ route('follow',['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="follow-btn">フォローする</button>
         </form>

            @endif
          </div>
       @endif
       @endforeach
    </li>
  </ul>
</div>





@endsection
