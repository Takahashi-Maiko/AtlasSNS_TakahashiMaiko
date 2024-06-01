@extends('layouts.logout')

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
 <ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
 </ul>
</div>
@endif


<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<div class=registerform-box>
 <p>新規ユーザー登録</p>

<!-- FormはPOST通信 -->
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('新規登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

</div>

{!! Form::close() !!}


@endsection
