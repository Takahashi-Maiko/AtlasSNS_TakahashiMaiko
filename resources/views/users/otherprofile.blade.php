<!-- アイコンをクリックしたらユーザーのプロフィールが表示されるページ -->

@extends('layouts.login')

@section('content')


@foreach($users as $user)

<div class="otherprofile-content">
  <!-- プロフィールの表示させたい(アイコン、名前、自己紹介文) -->
  <div class="otheruser-icon"><img src="{{asset('storage/images/'.$users()->$id()->images)}}" alt=""></div>


  <!-- ↓↓クリックしたユーザーの投稿を表示させたい -->
  <div class="otheruser-posts"></div>


</div>

@endforeach




@endsection
