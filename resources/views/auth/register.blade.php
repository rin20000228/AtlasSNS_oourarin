@extends('layouts.logout')

@section('content')

<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<!-- バリデーションエラーメッセージ -->
@foreach($errors->all() as $error)
<li class="register-error">{{ $error }}</li>
@endforeach

<div class="login-container">
  <div class="background">
    <div class="login-items">
      <p class="login-text">新規ユーザー登録</p>
      <ul>
        <li class="form-label">{{ Form::label('user name', 'user name') }}</li>
        <li class="form-text">{{ Form::text('username',null,['class' => 'input']) }}</li>
        <li class="form-label">{{ Form::label('mail address', 'mail address') }}</li>
        <li class="form-text">{{ Form::text('mail',null,['class' => 'input']) }}</li>
        <li class="form-label">{{ Form::label('password', 'password') }}</li>
        <li class="form-text">{{ Form::password('password',null,['class' => 'input']) }}</li>
        <li class="form-label">{{ Form::label('password_confirmation', 'password_confirmation') }}</li>
        <li class="form-text">{{ Form::password('password_confirmation',null,['class' => 'input']) }}</li>
        <form>
          <p><input class="btn btn-nexttop" type="submit" value="REGISTER"></p>
        </form>
      </ul>
      <p class="register-text"><a href="/login">ログイン画面へ戻る</a></p>
    </div>
  </div>
</div>
{!! Form::close() !!}


@endsection
