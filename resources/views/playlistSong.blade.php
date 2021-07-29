<div class="container-fluid">
    <div class="row row--grid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1>
                    @if (isset($album))
                        {{ $album->name }}
                    @elseif (isset($playlist))
                        {{ $playlist->name }}
                    @endif
                </h1>
            </div>  
        </div>
        <div class="col-12">
            <div class="release">
                <div class="release__content">
                    <div class="release__cover">
                        @if (isset($album))
                            <img class="image-detail" src="{{ $album->image}}" alt="" />
                        @elseif (isset($playlist))
                            <img class="image-detail" src="{{ $playlist->image }}" alt="">
                        @endif
                    </div>
                    <div class="release__stat">
                        <span class="track-number">
                            {{ count($songs).' '.trans('homePage.tracks') }} 
                        </span>
                    </div>
                        @if (isset($album))
                            
                        @elseif (isset($playlist))
                            <a href="" data-id ="{{ $playlist->id }}" class="release__buy open-modal add-song-btn">
                                {{ trans('homePage.addSongPlaylist') }} 
                            </a>
                        @endif
                </div>

                <div class="release__list" data-scrollbar="true" tabindex="-1" style="overflow: hidden; outline: none;">
                    <div class="scroll-content">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                            @if (count($songs) > 0)
                                @foreach ($songs as $song)
                                    <li id="songItem-{{ $song->id }}" class="single-item">
                                        <a class="single-item__cover">
                                            <img src="{{ $song->image }}" alt="" />
                                        </a>
                                        <div class="single-item__title">
                                            <h4><a class="play-music" href="#" data-id="{{ $song->id }}">{{ $loop->iteration }}. {{ $song->name }}</a></h4>
                                            <span><a href="">{{ $song->artist->name }}</a></span>
                                        </div>
                                        <a href="" data-id="{{ $song->id }}" title="{{ trans('homePage.playSong') }}" class="single-item__add play play-music">
                                            <i class="far fa-play-circle icon-play"></i>
                                            <i class="far fa-pause-circle icon-pause"></i>
                                        </a>
                                        <span class="single-item__export more-option">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                            <ul class="more-option-view">
                                                <li><a class="add-favorite-song" data-song ="{{ $song->id }}" href=""><i class="fa fa-heart" aria-hidden="true"></i> Add to favorite</a></li>
                                                <li class="add-to-playlist"><a><i class="fa fa-plus-circle" aria-hidden="true"></i> Add to playlists</a>
                                                    <ul class="sub-more">
                                                        @if (Auth::user()->playlists)
                                                            @foreach (Auth::user()->playlists as $item)
                                                                <li><a class="add-playlist-song" data-playlist=" {{ $item->id }}" data-song="{{ $song->id }}" href="">
                                                                    <i class="fa fa-play" aria-hidden="true"></i> {{ $item->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                                @if (isset($playlist))
                                                    <li><a class="del-playlist-song" data-playlist="{{ $playlist->id }}" data-song="{{ $song->id }}" href="">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </span>
                                    </li>
                                @endforeach
                            @else 
                                @if(isset($album))
                                    {{trans('homePage.noAlbumSong')}}
                                @else
                                    {{trans('homePage.noPlaylistSong')}}
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
