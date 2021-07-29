<div class="music">
    @if (isset($search))
        <h1 class="search-keyword"><i>@lang('homePage.searchKeyResult') "{{ $search }}"</i></h1>
    @endif
    <div class="recently_played">
        <h2 class="search-more" data-type="song" data-search="{{ $search }}">@lang('homePage.searchSong') 
            <i class="fa fa-chevron-right" aria-hidden="true"></i></h2>
        <div class="row">
            @if (count($songs) > 0)
                @foreach ($songs as $song)
                    <a class="box_music song-list" href="" data-id = "{{ $song->id }}">
                        <img src="{{ $song->image }}" alt="Loud Like Love">
                        <h3>{{ $song->name }}</h3>
                        <h4>{{ $song->artist->name }}</h4>
                    </a>
                @endforeach
            @else 
                <h3 class="search-key-result">@lang('homePage.noSearchSong')</h3>
            @endif  
        </div>    
    </div>
    <div class="album">
        <h2 class="search-more" data-type="album" data-search="{{ $search }}">@lang('homePage.searchAlbum') 
            <i class="fa fa-chevron-right" aria-hidden="true"></i></h2>
        <div class="row">
            @if (count($albums) > 0)
                @foreach ($albums as $album)
                    <a class="box_music album-detail" data-id={{ $album->id }} href=""">
                        <img src="{{ $album->image }}" alt="Death Cab fot Cutie">
                        <h3>{{ $album->name }}</h3>
                    </a>
                @endforeach
            @else 
                <h3 class="search-key-result">@lang('homePage.noSearchAlbum')</h3>
            @endif
        </div>
    </div>
    <div class="artist">
        <h2 class="search-more" data-type="artist" data-search="{{ $search }}">@lang('homePage.artistSong') 
            <i class="fa fa-chevron-right" aria-hidden="true"></i></h2>
        <div class="row">
            @if (count($artists) > 0)
                @foreach ($artists as $artist)
                    <a class="box_music artist-detail" data-id={{ $artist->id }} href="">
                        <img src="{{ $artist->image }}" alt="Death Cab fot Cutie">
                        <h3>{{ $artist->name }}</h3>
                    </a>
                @endforeach
            @else 
                <h3 class="search-key-result">@lang('homePage.noSearchArtist')</h3>
            @endif
        </div>
    </div>
</div>
