@extends('layouts.app')
@section('content')
    <section class="box_main" id="profile">
        <ul class="nav_bar_main">
           @foreach($categories as $category)
          <li>
          <a class="_home">{{$category->name}}</a>
             <ul class="sliding">
               @foreach($category->children as $cate)
              <li>
                <a  class="get_song" data-cate-id={{$cate->id}}>{{$cate->name}}</a>
                <hr>
              </li>
               @endforeach
            </ul>
           </li>
            @endforeach
        </ul>
        <div class="music">
            <div class="recently_played">
                <h2 class="title" >@lang('homePage.newestMusic')</h2>
                <div class="row list_song">
                    @if (isset($songs))
                        @foreach ($songs as $song)
                            <a class="box_music song-list" href="" data-id = "{{ $song->id }}">
                                <img src="/storage/{{ $song->image }}" alt="Loud Like Love">
                                <h3>{{ $song->name }}</h3>
                                <h4>{{ $song->artist->name }}</h4>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="album">
                <h2>@lang('homePage.albumSong')</h2>
                <div class="row get_album">
                    @foreach ($albums as $album)
                        <a class="box_music album-detail" data-id={{ $album->id }} href="">
                            <img src="{{ $album->image }}" alt="Death Cab fot Cutie">
                            <h3>{{ $album->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="artist">
                <h2>@lang('homePage.artistSong')</h2>
                <div class="row  get_artist">
                    @foreach ($artists as $artist)
                        <a class="box_music artist-detail" data-id={{ $artist->id }} href="">
                            <img src="{{ $artist->image }}" alt="Death Cab fot Cutie">
                            <h3>{{ $artist->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
  </div>
</div>
@stop
