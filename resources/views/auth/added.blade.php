@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="added-background">
    <p class="bold">{{ session('username') }}さん</p>
    <p class="bold">ようこそ！AtlasSNSへ！</p>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <p class="btn-redirect"><a href="/login">ログイン画面へ</a></p>
  </div>
</div>

@endsection
