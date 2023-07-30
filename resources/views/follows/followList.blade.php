@extends('layouts.login')

@section('content')
<div class="followlist-container">

  <h2>Follow List</h2>
  <div class="followlist-content">
    <!-- アイコンの一覧表示 -->
    @foreach($follows as $follow)
    <span class="follows-icon">
      <a href="/users/{{$follow->id}}/profile">
        <img src="{{ asset('storage/' .$follow->images) }}" alt="アイコン" width="45"></a>
    </span>
    @endforeach
  </div>
  <div class="line"></div>
  @foreach($posts as $post)
  <div class="followlist-item">
    <div>
      <!-- アイコンの表示 -->
      <ul class="post-flex">
        <a href="/users/{{$post->user->id}}/profile"><img src=" {{ asset('storage/' .$post->user->images) }}" alt="アイコン" width="50"></a>
        <li class="post-username">{{ $post->user->username }}</li>
        <li class="followList-time">{{ $post->created_at }}</li>
      </ul>
    </div>
    <ul>
      <li class="post-detail">{{ $post->post }}</li>
    </ul>
  </div>
  @endforeach
</div>


@endsection
