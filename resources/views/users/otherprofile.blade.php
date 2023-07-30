@extends('layouts.login')

@section('content')
<div class="profile_container">
  @yield('content')
  @foreach($profile as $profile)
  <ul class="profile_content">
    <li><img src="{{ asset('storage/' .$profile->images) }}" alt="アイコン" width="50"></li>
    <span class="profile_name">
      <li>name</li>
      <li class="username">{{ $profile->username }}</li>
    </span>
    <span class="profile_bio">
      <li>bio</li>
      <li class="bio">{{ $profile->bio }}</li>
    </span>

    <teble>
      <!-- ログインユーザーがフォローしていたら、フォロー解除ボタンを表示 -->
      @if (Auth::user()->isFollowing($profile->id))
      <tr class="profile-btn">
        <!-- ログインユーザーがフォローしていたら、フォロー解除ボタンを表示 -->
        <!-- フォロー解除ボタン　-->
        <td class="unfollow_btn">
          <button type="button" class="profile_unfollow_input">
            <a href="/user/{{ $profile->id }}/unfollow">フォロー解除</a>
          </button>
        </td>
        <!-- フォローしていなければ、フォローするボタンを表示　-->
        @else
        <!-- フォローするボタン -->
        <td class="following_btn">
          <button type="button" class="profile_follow_input">
            <a href="/user/{{ $profile->id }}/follow">フォローする</a>
          </button>
        </td>
      </tr>
  </ul>
  @endif
  @endforeach
</div>

</teble>
@foreach($posts as $post)

<div class="otherProfile_post">
  <ul class="profile_post-flex">
    <!-- アイコンの表示 -->
    <div><img src="{{ asset('storage/' .$post->user->images) }}" alt="アイコン" width="45"></div>
    <li class="post-username">{{ $post->user->username }}</li>
    <li class="profile_post-time">{{ $post->created_at }}</li>
  </ul>
  <ul>
    <li class="post-detail">{{ $post->post }}</li>
  </ul>
</div>
@endforeach
@endsection
