<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LMussic - Trang quản lý</title>
    <base href="{{ asset('') }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">LMussic</a>
            </div>
            <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{auth()->user()->fullname}}<i class="fa fa-user"></i>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i>@lang('adminhome.logout')</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                  <div class="dropdown">
                       @php $locale = session()->get('locale'); @endphp
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('vi')
                                <img src="{{asset('image/vi.png')}}"> VN
                                @break
                                @case('en')
                                <img src="{{asset('image/en.png')}}"> English
                                @break
                                @default
                                <img src="{{asset('image/vi.png')}}"> VN
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('change-language',['vi'])}}"><img src="{{asset('image/vi.png')}}"> VN</a>
                            <a class="dropdown-item" href="{{route('change-language',['en'])}}"><img src="{{asset('image/en.png')}}"> English</a>
                        </div>
                     </div>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href=""><i class="fa fa-fw fa-home"></i> @lang('adminhome.home')</a>
                    </li>
                    <li class="">
                        <a href="{{ route('categories.index') }}"><i class="fa fa-fw fa-bar-chart-o"></i> @lang('adminhome.category')</a>
                    </li>
                    <li class="">
                        <a href="{{ route('songs.index')}}"><i class="fa fa-play-circle-o" aria-hidden="true"></i> @lang('adminhome.song') </a>
                    </li>
                    <li class="{{ \Request::route()->getName() == 'lyric.index' ? 'active' : '' }}">
                        <a href="{{route('lyric.index')}}"><i class="fa fa-files-o" aria-hidden="true"></i>
                         @lang('adminhome.lyris') </a>
                    </li>
                    <li class="">
                        <a href="{{ route('albums.index') }}"><i class="fa fa-book" aria-hidden="true"></i>
                    </i> @lang('adminhome.albumn') </a>
                    </li>

                     <li class="{{ \Request::route()->getName() == 'artist.index' ? 'active' : '' }}">
                        <a href="{{route('artist.index')}}"><i class="fa fa-music" aria-hidden="true"></i>
                    </i> @lang('adminhome.signer') </a>
                    </li>
                    <li class="{{ \Request::route()->getName() == 'user.index' ?
                     'active' : ''}}">
                        <a href="{{route('user.index')}}"><i class="fa fa-users" aria-hidden="true"></i>
                    </i> User</a>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-comments-o" aria-hidden="true"></i> @lang('adminhome.comment')</a>
                    </li>
                </ul>
            </div>
        </nav>
        @include('admin.layout.notification')
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('js/showimg.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{asset('js/delartis.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/delCategory.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</body>
</html>
