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
@endif
@endforeach
    <!-- <a href="">
        {{ $user->username }}
    </a> -->

    <!-- ↓↓フォローされているかの判定(2024/1/12) -->
@if (auth()->user()->isFollowed($user->id))
@endif

    <!-- ↓↓フォローしているかの判定(2024/1/12) -->
@if (auth()->user()->isFollowing($user->id))
@endif

</table>
</div>



@endsection
