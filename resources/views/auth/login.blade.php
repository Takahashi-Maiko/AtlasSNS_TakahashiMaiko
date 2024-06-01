@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<div class=form-box>
  <p>AtlasSNSへようこそ</p>

<!-- FormはPOST通信 -->
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('ログイン') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

</div>

@endsection
