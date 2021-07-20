@extends('layouts.app')
@section('content')
    <section class="box_main">
        <ul class="nav_bar_main">
            <li><a href="#">New releases</a></li>
            <li><a href="#">Charts</a></li>
            <li><a href="#">Discover</a></li>
            <li><a href="#">For you</a></li>
            <li><a href="#">Genre</a></li>
            <li><a href="#">Podcast</a></li>
        </ul>
        <div class="music">
            <div class="recently_played">
                <h2>@lang('home.song')</h2>
                <div class="row">
                        @foreach ($songs as $song)
                            <a class="box_music song-list" href="" data-id = "{{ $song->id }}">
                                <img src="{{ $song->image }}" alt="Loud Like Love">
                                <h3>{{ $song->name }}</h3>
                                <h4>{{ $song->artist->name }}</h4>
                            </a>
                        @endforeach
                </div>
            </div>
            <div class="artists">
                <h2>@lang('home.artist')</h2>
                <div class="row">
                    <a class="box_music" href="#">
                        <img src="img/artists/death-cab-for-cutie.jpg" alt="Death Cab fot Cutie">
                        <h3>Death Cab fot Cutie</h3>
                    </a>
                    <a class="box_music" href="#">
                        <img src="img/artists/florence-the-machine.jpg" alt="Florence + The Machine">
                        <h3>Florence + The Machine</h3>
                    </a>
                    <a class="box_music" href="#">
                        <img src="img/artists/imagine-dragons.jpg" alt="Imagine Dragons">
                        <h3>Imagine Dragons</h3>
                    </a>
                    <a class="box_music" href="#">
                        <img src="img/artists/the-xx.jpg" alt="The xx">
                        <h3>The xx</h3>
                    </a>
                </div>
            </div>
            <div class="daily-mix">
                <h2>@lang('home.album')</h2>
                <div class="row">
                    <a class="box_music" href="#">
                        <img src="img/daily-mix/daily-mix-1.jpg" alt="Daily Mix 1">
                        <h3>Daily Mix 1</h3>
                    </a>
                    <a class="box_music" href="#">
                        <img src="img/daily-mix/daily-mix-2.jpg" alt="Daily Mix 2">
                        <h3>Daily Mix 2</h3>
                    </a><a class="box_music" href="#">
                        <img src="img/daily-mix/daily-mix-3.jpg" alt="Daily Mix 3">
                        <h3>Daily Mix 3</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
    </div>
@stop
