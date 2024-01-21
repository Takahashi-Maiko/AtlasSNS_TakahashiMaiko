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
<!-- 自分以外のユーザーを表示 -->
@if(!($user->username == Auth::user()->username))
<tr>
  <td>{{$user->username}}</td>
  <td><img src="{{$user->images}}" alt="ユーザーアイコン"></td>
</tr>

<div>
  <div>{{$user->username}}</div>
  <button onclick="follow({{ $user->id }})">フォローする</button>
</div>

@endif
@endforeach

<!-- @foreach($users as $user)
<div>
  <div>{{$user->username}}</div>
  <button onclick="follow({{ $user->id }})">フォローする</button>
</div>
@endforeach -->

    <!-- ↓↓フォローされているかの判定(2024/1/12) -->
@if (auth()->user()->isFollowed($user->id))
<form action="/users/{{$user->id}}/Follow,['id'=>$user->id]"method="POST">
   <button type="submit" class="unfollow-btn">フォロー解除</button>
</form>
@else
<form action="/users/{{$user->id}}/unFollow,['id'=>$user->id]"method="POST">
  <button type="submit" class="follow-btn">フォローする</button>
</form>
@endif

    <!-- ↓↓フォローしているかの判定(2024/1/12) -->
<!-- @if (auth()->user()->isFollowing($user->id))
@endif -->

</table>
</div>



@endsection
