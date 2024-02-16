@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

<!-- 投稿フォームの設置(2023/12/19) -->
<div class="container">
  <!-- ↓↓/topへ送る為。 -->
 {!! Form::open(['url' => '/top']) !!}
 {{ Form::token() }}
 <div class="form-group">
  {{ Form::input('text','newPost',null,['required','class' => 'form-control','placeholder' => '投稿内容を入力して下さい'])}}
 </div>
 <button type="submit" class="tweet-btn"><img src="images/post.png" alt="送信"></button>

 <!-- ↓↓バリデーションのif文でエラーが無い場合には表示しないように設定。 -->
  @if($errors->first('post'))
  @endif

  @foreach($post as $posts)
  <div class="post-content">
    <tr>
      <td>{{ $post->user->username }}</td>
      <td>{{ $post->post}}</td>
      <td>{{ $post->create_at }}</td>
    </tr>
  </div>

  @endforeach

 {!! Form::close() !!}
</div>





@endsection
