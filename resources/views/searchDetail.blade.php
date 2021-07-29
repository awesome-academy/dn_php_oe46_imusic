<div class="music">
    @if (isset($search))
        <h1 class="search-keyword"><i>@lang('homePage.searchKeyResult') "{{ $search }}"</i></h1>
    @endif
    <div class="recently_played">
        <h2 class="search-more">
            @if (isset($songs))
                @lang('homePage.searchSong')
            @elseif (isset($albums))
                @lang('homePage.searchAlbum')
            @elseif (isset($artists))
                @lang('homePage.artistSong')
            @endif
            <i class="fa fa-chevron-right" aria-hidden="true"></i></h2>
        <div class="row">
            @if (isset($songs))
                @foreach ($songs as $song)
                    <a class="box_music song-list" href="" data-id = "{{ $song->id }}">
                        <img src="{{ $song->image }}" alt="Loud Like Love">
                        <h3>{{ $song->name }}</h3>
                        <h4>{{ $song->artist->name }}</h4>
                    </a>
                @endforeach
            @elseif (isset($albums))
                @foreach ($albums as $album)
                    <a class="box_music album-detail" data-id={{ $album->id }} href=""">
                        <img src="{{ $album->image }}" alt="Death Cab fot Cutie">
                        <h3>{{ $album->name }}</h3>
                    </a>
                @endforeach
            @elseif (isset($artists))
                @foreach ($artists as $artist)
                    <a class="box_music artist-detail" data-id={{ $artist->id }} href="">
                        <img src="{{ $artist->image }}" alt="Death Cab fot Cutie">
                        <h3>{{ $artist->name }}</h3>
                    </a>
                @endforeach
            @else 
                <h3 class="search-key-result">@lang('homePage.noSearchSong')</h3>
            @endif  
        </div>    
        @if (isset($songs))
            {{ $songs->links() }}
        @elseif (isset($albums))
            {{ $albums->links() }}
        @elseif (isset($artists))
            {{ $artists->links() }}
        @endif
    </div>
</div>
