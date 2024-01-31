@extends('layouts.login')

@section('content')



<form method="GET" action="{{ route('users.search') }}">
<input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
<button type="submit" class=""> <img src="./images/search.png"></button>
</form>

<!-- 検索キーワードの表示 -->
@if(!empty($keyword))
<p>検索ワード:{{$keyword}}</p>
@endif

<!-- 保存されているユーザー一覧の表示 -->
<div class="container-list">
  <table class="table table-hover">
@foreach($users as $user)
<!-- foreachで$usersから1つずつ$userとして取り出し表示させる -->
<!-- 自分以外のユーザーを表示 -->
<div>
@if(!($user->username == Auth::user()->username))
  {{$user->username}}
  <img src="{{$user->images}}" alt="ユーザーアイコン">

<!-- ↓↓フォローボタンの設置(2024/1/21) -->
<!-- csrfはform毎に記述が必要 -->
@if (auth()->user()->isFollowed($user->id))
<!-- <form action="users/{$id}/follow" method="POST">
   @csrf
   <button type="submit" class="unfollow-btn">フォロー解除</button>
</form> -->
<form action="{{ route('unfollow',['id' => $user->id]) }}" method="POST">
   @csrf
   <button type="submit" class="unfollow-btn">フォロー解除</button>
</form>

@else
<!-- <form action="users/{$id}/unfollow" method="POST">
   @csrf
  <button type="submit" class="follow-btn">フォローする</button>
</form> -->
<form action="{{ route('follow',['id' => $user->id]) }}" method="POST">
   @csrf
  <button type="submit" class="follow-btn">フォローする</button>
</form>

@endif
</div>
@endif
@endforeach

    <!-- ↓↓フォローされているかの判定(2024/1/12) -->
<!-- @if (auth()->user()->isFollowed($user->id))
<form action="/users/{{$user->id}}/Follow,"method="POST">
   <button type="submit" class="unfollow-btn">フォロー解除</button>
</form>
@else
<form action="/users/{{$user->id}}/unFollow,"method="POST">
  <button type="submit" class="follow-btn">フォローする</button>
</form>
@endif -->

    <!-- ↓↓フォローしているかの判定(2024/1/12) -->
<!-- @if (auth()->user()->isFollowing($user->id))
@endif -->

</table>
</div>



@endsection
