@extends('layouts.login')

@section('content')



<form method="GET" action="{{ route('users.index') }}">
<input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
<button type="submit" class=""> <img src="./images/search.png"></button>
</form>

<!-- 検索キーワードの表示 -->
@if(!empty($keyword))
<p>検索ワード:{{$keyword}}</p>
@endif

@foreach($users as $user)
    <a href="{{ route('users.show', ['user_id' => $user->id]) }}">
        {{ $user->name }}
    </a>
@endforeach


@endsection
