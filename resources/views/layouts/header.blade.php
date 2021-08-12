<div class="header">
    <section class="nav_bar_top">
        <div class="top">
          <a class="logo_link" href="{{ route('home') }}">
            <svg class="logo" viewBox="0 0 1134 340"><title>Spotify</title><path fill="white" d="M8 171c0 92 76 168 168 168s168-76 168-168S268 4 176 4 8 79 8 171zm230 78c-39-24-89-30-147-17-14 2-16-18-4-20 64-15 118-8 162 19 11 7 0 24-11 18zm17-45c-45-28-114-36-167-20-17 5-23-21-7-25 61-18 136-9 188 23 14 9 0 31-14 22zM80 133c-17 6-28-23-9-30 59-18 159-15 221 22 17 9 1 37-17 27-54-32-144-35-195-19zm379 91c-17 0-33-6-47-20-1 0-1 1-1 1l-16 19c-1 1-1 2 0 3 18 16 40 24 64 24 34 0 55-19 55-47 0-24-15-37-50-46-29-7-34-12-34-22s10-16 23-16 25 5 39 15c0 0 1 1 2 1s1-1 1-1l14-20c1-1 1-1 0-2-16-13-35-20-56-20-31 0-53 19-53 46 0 29 20 38 52 46 28 6 32 12 32 22 0 11-10 17-25 17zm95-77v-13c0-1-1-2-2-2h-26c-1 0-2 1-2 2v147c0 1 1 2 2 2h26c1 0 2-1 2-2v-46c10 11 21 16 36 16 27 0 54-21 54-61s-27-60-54-60c-15 0-26 5-36 17zm30 78c-18 0-31-15-31-35s13-34 31-34 30 14 30 34-12 35-30 35zm68-34c0 34 27 60 62 60s62-27 62-61-26-60-61-60-63 27-63 61zm30-1c0-20 13-34 32-34s33 15 33 35-13 34-32 34-33-15-33-35zm140-58v-29c0-1 0-2-1-2h-26c-1 0-2 1-2 2v29h-13c-1 0-2 1-2 2v22c0 1 1 2 2 2h13v58c0 23 11 35 34 35 9 0 18-2 25-6 1 0 1-1 1-2v-21c0-1 0-2-1-2h-2c-5 3-11 4-16 4-8 0-12-4-12-12v-54h30c1 0 2-1 2-2v-22c0-1-1-2-2-2h-30zm129-3c0-11 4-15 13-15 5 0 10 0 15 2h1s1-1 1-2V93c0-1 0-2-1-2-5-2-12-3-22-3-24 0-36 14-36 39v5h-13c-1 0-2 1-2 2v22c0 1 1 2 2 2h13v89c0 1 1 2 2 2h26c1 0 1-1 1-2v-89h25l37 89c-4 9-8 11-14 11-5 0-10-1-15-4h-1l-1 1-9 19c0 1 0 3 1 3 9 5 17 7 27 7 19 0 30-9 39-33l45-116v-2c0-1-1-1-2-1h-27c-1 0-1 1-1 2l-28 78-30-78c0-1-1-2-2-2h-44v-3zm-83 3c-1 0-2 1-2 2v113c0 1 1 2 2 2h26c1 0 1-1 1-2V134c0-1 0-2-1-2h-26zm-6-33c0 10 9 19 19 19s18-9 18-19-8-18-18-18-19 8-19 18zm245 69c10 0 19-8 19-18s-9-18-19-18-18 8-18 18 8 18 18 18zm0-34c9 0 17 7 17 16s-8 16-17 16-16-7-16-16 7-16 16-16zm4 18c3-1 5-3 5-6 0-4-4-6-8-6h-8v19h4v-6h4l4 6h5zm-3-9c2 0 4 1 4 3s-2 3-4 3h-4v-6h4z"></path></svg>
          </a>
          <a href="#"><img class="logo-small white" src="img/icons/logo-small.svg" alt="Spotify"></a>
          <ul class="menu">
            <li>
              <a href="{{ route('home') }}">
                <svg viewBox="0 0 512 512" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M448 463.746h-149.333v-149.333h-85.334v149.333h-149.333v-315.428l192-111.746 192 110.984v316.19z"></path></svg>
                <span class="white"> @lang('home.home')</span>

              </a>
            </li>
            <li>
              <div class="dropdown_r">
                <p class="dropbtn_r">  <i class="far fa-sort"></i> Hot</p>
                <div class="dropdown-content_r">
                  <a href="#" class="_hotS" data-song ="1">Song Hot</a>
                  <a href="#" class="_hotA" data-album="1">Ablum Hot</a>
                </div>
                </div>
            </li>
            <li>
              <a href="" class="top_tren">
                <svg viewBox="0 0 512 512" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M291.301 81.778l166.349 373.587-19.301 8.635-166.349-373.587zM64 463.746v-384h21.334v384h-21.334zM192 463.746v-384h21.334v384h-21.334z"></path></svg>
                <span> @lang('home.top')</span>
              </a>
            </li>
            <li>
              <a href="#">
                <svg viewBox="0 0 512 512" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M291.301 81.778l166.349 373.587-19.301 8.635-166.349-373.587zM64 463.746v-384h21.334v384h-21.334zM192 463.746v-384h21.334v384h-21.334z"></path></svg>
                <span> @lang('home.libri')</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="middle">
          <h4 class="white">@lang('home.playlist')</h4>
          <a href="" class="manage-playlist"><i class="fa fa-cog" aria-hidden="true"></i>
            <span>@lang('playlist.managePlaylist')</span>
          </a>
          <a class="btn_playlist" href="{{ route('createPlaylists') }}">
            <svg class="plus" shape-rendering="crispEdges" viewBox="0 0 36 36"><path d="m28 20h-8v8h-4v-8h-8v-4h8v-8h4v8h8v4z"></path></svg>
            <span> @lang('home.newplaylist')</span>
          </a>
          @if (Auth::check())
            <ul class="playlist">
              @if (isset(Auth::user()->playlists))
                @foreach(Auth::user()->playlists as $playlist)
                  <li><a class="play-playlist" data-id="{{ $playlist->id}}" href="#"> {{ $playlist->name}} </a></li>
                @endforeach
              @endif
              @if (isset(Auth::user()->albums))
                @foreach(Auth::user()->albums as $album)
                  <li><a class="play-favAlbum" data-id="{{ $album->id }}"href="#"> {{ $album->name}} </a></li>
                @endforeach
            @endif
            </ul>
          @endif
        </div>
     </section>
</div>
<div class="main">
    <div class="upgrade">
      <form id="search-form" method="get">
        <div class="inner-form">
          <div class="input-field first-wrap">
            <div class="svg-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
              </svg>
            </div>
            <input id="search" type="text" placeholder= "@lang('home.placeholder')" />
          </div>
          <div class="input-field second-wrap">
            <button class="btn-search" type="submit">@lang('home.search')</button>
          </div>
        </div>
      </form>
      <div>
          @if(Auth::check())
          <a class="btn_signup " id="pro_file" data-user-profile="{{ auth()->user()->id}}" href=""><i class="fas fa-user-circle"></i> {{auth()->user()->fullname}} </a>
          <a class="btn_login " href="{{route('logout')}}">LOG OUT</a>
          @else
          <a class="btn_signup " href="{{route('get.register')}}">SIGN UP</a>
          <a class="btn_login " href="{{route('get.login')}}">LOG IN</a>
          @endif
      </div>
      <div class="notification">
          @if(Auth::check())
          <div class="cart-items">{{Auth::user()->unreadNotifications->count()}}</div>
          @endif
          <div class="cart-box">
              <div class="cart-icon">
                <i class="far fa-bell"></i>
              </div>
              <div class="cart-product">
                  <div class="cart-product-list">
                      <table>
                          <tbody class="new-notify">
                            @if(Auth::check())
                                @foreach(Auth::user()->unReadNotifications as $notification)
                                  <tr class="notif-count" id="detail-noti" data-id ="{{$notification->id}}" data-song="{{$notification->data['id']}}">
                                    <td class="product-pic">
                                      <a href="">
                                        <img src="/storage/{{$notification->data['image']}}" alt="">
                                      </a>
                                    </td>
                                    <td class="product-text">
                                      <a href="">
                                        <div class="product-info">
                                          <p class="new-noti">@lang('home.newSongNoti'):</p>
                                          <h5 class="noti-name">{{$notification->data['name']}}</h5>
                                          <p class="noti-time">{{$notification->created_at->diffForHumans()}}</p>
                                        </div>
                                      </a>
                                    </td>
                                  </tr>
                                @endforeach
                            @else
                            <tr>
                              <td class="text-danger">@lang('home.notlogin')</td>
                            </tr>
                            @endif
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="nav-item dropdown">
        <div class="dropdown">
             @php $locale = session()->get('locale'); @endphp
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  @switch($locale)
                      @case('vi')
                        <img src="{{asset('storage/img/vn.png')}}"> VN
                      @break
                      @case('en')
                        <img src="{{asset('storage/img/en.png')}}"> English
                      @break
                      @default
                        <img src="{{asset('storage/img/vn.png')}}"> VN
                  @endswitch
                  <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('change-language',['vi'])}}"><img src="{{asset('storage/img/vn.png')}}"> VN</a>
                  <a class="dropdown-item" href="{{route('change-language',['en'])}}"><img src="{{asset('storage/img/en.png')}}"> English</a>
              </div>
           </div>
        </div>
      </div>
