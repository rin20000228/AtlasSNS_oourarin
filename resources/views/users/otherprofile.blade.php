@extends('layouts.login')

@section('content')
<div class="other-container">
  @yield('content')
  @foreach($profile as $profile)
  <div class="profile-content">
    <div class="profile-top">
      <div>
        <img src="{{ asset('storage/' .$profile->images) }}" alt="アイコン" width="50">
      </div>
      <div class="otherProfile-items">
        <ul class="profile-name">
          <li class="name">name</li>
          <li>{{ $profile->username }}</li>
        </ul>
        <ul class="profile-bio">
          <li class="bio">bio</li>
          <li>{{ $profile->bio }}</li>
        </ul>
      </div>
    </div>
    <div class="btn-otherProfile">
      <teble>
        <!-- ログインユーザーがフォローしていたら、フォロー解除ボタンを表示 -->
        @if (Auth::user()->isFollowing($profile->id))
        <tr class="profile-btn">
          <!-- ログインユーザーがフォローしていたら、フォロー解除ボタンを表示 -->
          <!-- フォロー解除ボタン　-->
          <td class="unfollow_btn">
            <button type="button" class="profile_unfollow-input">
              <a href="/user/{{ $profile->id }}/unfollow">フォロー解除</a>
            </button>
          </td>
          <!-- フォローしていなければ、フォローするボタンを表示　-->
          @else
          <!-- フォローするボタン -->
          <td class="following_btn">
            <button type="button" class="profile_follow-input">
              <a href="/user/{{ $profile->id }}/follow">フォローする</a>
            </button>
          </td>
        </tr>
        @endif
      </teble>
    </div>
  </div>
  @endforeach
</div>


<!-- 相手ユーザーの投稿一覧 -->
@foreach($posts as $post)

<div class="otherProfile-post">
  <!-- アイコンの表示 -->
  <div>
    <img src="{{ asset('storage/' .$post->user->images) }}" alt="アイコン" width="45">
  </div>
  <div>
    <ul class="otherPost-flex">
      <li class="post-username">{{ $post->user->username }}</li>
      <li class="profile_post-time">{{ $post->created_at }}</li>
    </ul>
    <p class="other-post">{{ $post->post }}</p>
  </div>
</div>
@endforeach
@endsection
