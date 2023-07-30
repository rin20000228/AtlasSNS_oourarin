@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
{!! Form::open(['url' => 'post/create']) !!}
<!-- バリデーションエラーメッセージ -->
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="form-container">
  <img class="auth-icon" src="{{ \Storage::url(Auth::user()->images) }}" alt="アイコン" width="50">
  <!--引数：①入力のtype属性②name属性の指定：posで渡す名前になりコントローラーのリクエスト受け取る際の名称③フォーム内の初期値の指定④その他-->
  <span>{{Form::textarea('post', null, ['required', 'class' => 'post', 'placeholder' => '投稿内容を入力してください。'])}}</span>
  <div class="form-btn-container">
    <button input="submit" class="post-btn" href="">
      <img class="btn-success" src="images/post.png" alt="送信">
    </button>
  </div>
</div>
{!! Form::close() !!}

<!-- 投稿の一覧表示 -->
@foreach ($posts as $post)
<!-- userテーブルとリレーションして、usernameカラムを変数postに入れる  -->
<div class="post-container">
  <div class="post-content">
    <div>
      <ul class="post-flex">
        <!-- アイコンの表示 -->
        <div>
          <img src="{{ asset('storage/' .$post->user->images) }}" alt="アイコン" width="40">
        </div>
        <li class="post-username">{{ $post->user->username }}</li>
        <li class="post-time">{{ $post->created_at }}</li>
      </ul>
    </div>
    <ul>
      <li class="post-detail">{{ $post->post }}</li>
    </ul>
    <!-- ログインユーザーのIDと投稿のIDが一致した時、編集と削除が行える -->
    @if(Auth::user()->id == $post->user->id)
    <!-- 投稿の編集ボタン -->
    <div class="modal-container">
      <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" width="30"></a>
      <!-- 投稿の削除 -->
      <a class="post-delete" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
        <img class="delete" src="images/trash-h.png" alt="削除">
        <img class="delete-hover" src="images/trash.png" alt="ホバー">
      </a>
    </div>
    @endif

  </div>

</div>
@endforeach
<!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/post/update" method="post">
      <textarea name="upPost" class="modal_post" value=""></textarea>
      <!-- 見えない状態でpostのidをvalueで送る。コントローラーではname属性で受け取る -->
      <input type="hidden" name="postId" class="modal_id" value="">
      <div class="postUpdate_container">
        <img class="postUpdate_img" src="images/edit.png" alt="編集" width="40">
        <input class="btn-post_update" type="submit" value="更新">
      </div>
      {{ csrf_field() }}
    </form>
    <a class="js-modal-close" href=""></a>
  </div>
</div>
@endsection
