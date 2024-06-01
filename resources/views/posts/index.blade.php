@extends('layouts.login')

@section('content')
<!-- <h2>機能を実装していきましょう。</h2> -->



<!-- 投稿フォームの設置(2023/12/19) -->
<div class="container">
  <!-- ↓↓アイコンの表示 -->
  <div class="user-icon"><img src="{{asset('storage/images/'.Auth::user()->images)}}" alt=""></div>
  <!-- ↓↓/topへ送る為。 -->
  {!! Form::open(['url' => '/top']) !!}
  {{ Form::token() }}
  <div class="form-group">
    <input type="image" name="images" value=""><img src="{{asset('storage/'.Auth::user()->images)}}" alt="">
    {{ Form::input('text','newPost',null,['required','class' => 'form-control','placeholder' => '投稿内容を入力して下さい'])}}
    <button type="submit" class="tweet-btn"></button>
    {!! Form::close() !!}
  </div>
</div>


 <!-- ↓↓バリデーションのif文でエラーが無い場合には表示しないように設定。 -->
  @if($errors->first('post'))
  @endif

  <!-- バリデーションのエラー表示 -->
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- ↓↓投稿表示画面編集 2024/5/11 -->
    @foreach($post as $posts)

    <ul>
  <li class="post-block">
      <!-- postsテーブルのとusersテーブルのリレーションを行う(1(users)対多(posts)の関係) -->
      <!-- $posts->user->usernameのuserはリレーションの記述のuserメソッドを使っている。 -->
      <div class="icon"><img class="icon-img" src="{{asset('storage/images/' .$posts->user->images)}}" alt="ユーザーアイコン"></div>
       <div class=post-content>
        <div>
         <div class="username">{{ $posts->user->username }}</div>
         <div class="create_at">{{ $posts->created_at }}</div>
        </div>
         <div class="post">{{ $posts->post}}</div>
       </div>
      <!-- ↓↓ログインユーザーのidと投稿($post)のuser_idが一致する場合は編集と削除の表示が出来る様に条件分岐する。 -->
  @if ($user_id == $posts->user_id)
      <div class="edit-content">
        <!-- ↓↓編集の投稿ボタン 2024/2/24 -->
        <!-- 編集ボタンにpost属性とpost_id属性を追加し、それぞれの投稿内容と投稿idのデータを持たせる(例：「こんにちは」と投稿された投稿に設置されているボタンではpost="こんにちは"となる) -->
        <a class="js-modal-open" href="" post="{{ $posts->post }}" post_id="{{ $posts->id }}">
          <img class="edit-img" src="images/edit.png" width="25px" height="25px" alt="編集ボタン"></a>
      </div>

    <!-- ↓↓削除ボタン -->
      <div class=delete-btn>
        <a href="/top/{{ $posts->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
          <img class="delete-img" src="images/trash-h.png" alt="削除時">
          <!-- ↓↓ホバー時に削除ボタンの色が反転する為(削除ボタンを押したとき)。 -->
          <img class="deleted-img" src="images/trash.png" alt="削除前"></a>
      </div>
    </ul>
    @endif
  </li>
  @endforeach




  <!-- foreach($post as $posts) -->
  <!-- <div class="post-content"> -->
    <!-- <ul> -->
      <!-- postsテーブルのとusersテーブルのリレーションを行う(1(users)対多(posts)の関係) -->
      <!-- $posts->user->usernameのuserはリレーションの記述のuserメソッドを使っている。 -->
      <!-- <li class="icon"><img class="icon-img" src="{{asset('storage/images/' .$posts->user->images)}}" alt="ユーザーアイコン"></li>
      <li class="username">{{ $posts->user->username }}</li>
      <li class="post">{{ $posts->post}}</li>
      <li class="create_at">{{ $posts->created_at }}</li> -->
      <!-- ↓↓ログインユーザーのidと投稿($post)のuser_idが一致する場合は編集と削除の表示が出来る様に条件分岐する。 -->
  <!-- if ($user_id == $posts->user_id)
      <div class="edit-content"> -->
        <!-- ↓↓編集の投稿ボタン 2024/2/24 -->
        <!-- 編集ボタンにpost属性とpost_id属性を追加し、それぞれの投稿内容と投稿idのデータを持たせる(例：「こんにちは」と投稿された投稿に設置されているボタンではpost="こんにちは"となる) -->
        <!-- <a class="js-modal-open" href="" post="{{ $posts->post }}" post_id="{{ $posts->id }}">
          <img class="edit-img" src="images/edit.png" width="25px" height="25px" alt="編集ボタン"></a>
      </div> -->

    <!-- ↓↓削除ボタン -->
      <!-- <div class=delete-btn>
        <a href="/top/{{ $posts->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
        <img class="delete-img" src="images/trash.png" width="25px" height="25px" alt="削除前"> -->
        <!-- ↓↓ホバー時に削除ボタンの色が反転する為(削除ボタンを押したとき)。 -->
        <!-- <img class="delete-img" src="images/trash-h.png" width="25px" height="25px" alt="削除時"></a>
      </div>
    </ul>
    endif
  </div>
  endforeach -->


  <!-- ↓↓投稿を編集する為のモーダルの中身 (2024/2/21) -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/postUpdate" method="POST">
        @csrf
        <textarea name="text" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id" value="">
        <input type="image" src="images/edit.png"  alt="編集を確定する" >
      </form>
      <a class="js-modal-close" href=""></a>
    </div>
  </div>

@endsection
