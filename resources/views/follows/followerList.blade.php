@extends('layouts.login')

@section('content')
<!-- ログインユーザーがフォローされているユーザーを表示する　-->
<div class="followerlist-container">

  <h2>Follower List</h2>
  <div class="followerlist-content">
    <!-- アイコンの一覧表示 -->
    @foreach($followers as $follower)
    <span class="follower_icon">
      <a href="/users/{{$follower->id}}/profile">
        <img src=" {{ asset('storage/' .$follower->images) }}" alt="アイコン" width="45">
      </a>
    </span>
    @endforeach
  </div>
  <div class="line"></div>
  @foreach($posts as $post)
  <div class="followerlist-item">
    <div>
      <!-- アイコンの表示 -->
      <ul class="post-flex">
        <a href="/users/{{$post->user->id}}/profile"><img src="{{ asset('storage/' .$post->user->images) }}" alt="アイコン" width="50"></a>
        <li class="post-username">{{ $post->user->username }}</li>
        <li class="followerList-time">{{ $post->created_at }}</li>
      </ul>
    </div>
    <ul>
      <li class="post-detail">{{ $post->post }}</li>
    </ul>
  </div>
  @endforeach
</div>


@endsection
