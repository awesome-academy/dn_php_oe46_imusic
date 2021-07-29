<section class="box_main">
<div class="container-fluid">
    <div class="row row--grid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1>
                    @if (isset($album))
                        {{ $album->name }}
                    @elseif (isset($artist))
                        {{ $artist->name }}
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
                        @elseif (isset($artist))
                            <img class="image-detail" src="{{ $artist->avatar }}" alt="">
                        @endif
                    </div>
                    <div class="release__stat">
                        <span class="track-number">
                            {{ count($songs).' '.trans('homePage.tracks') }} 
                        </span>
                    </div>
                       @if (isset($album))
                          @if($check !='')
                            @if(count($check) > 0)
                                <a class="release__buy open-modal">
                                    <i class="fa fa-check-circle added" aria-hidden="true"></i>
                                    {{ trans('homePage.addedAlbum') }}
                                </a>
                            @else
                                <a href="" data-id ="{{ $album->id }}" class="release__buy open-modal add-album-btn">
                                    <i class="fa fa-plus-circle nonAdd" aria-hidden="true"></i>
                                    <i class="fa fa-check-circle added" aria-hidden="true"></i>
                                    {{ trans('homePage.addAlbum') }}
                                </a>
                            @endif
                           @endif
                        @elseif (isset($artist))
                            @lang('homePage.artistInfo')
                            <p>{{ $artist->info }}</p>
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
                                                        @if(Auth::check())
                                                            @if (Auth::user()->playlists)
                                                                @foreach (Auth::user()->playlists as $item)
                                                                    <li><a class="add-playlist-song" data-playlist=" {{ $item->id }}" data-song="{{ $song->id }}" href="">
                                                                        <i class="fa fa-play" aria-hidden="true"></i> {{ $item->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </ul>
                                                </li>
                                            </ul>
                                        </span>
                                    </li>
                                @endforeach
                            @else 
                                @if(isset($album))
                                    {{trans('homePage.noAlbumSong')}}
                                @else
                                    {{trans('homePage.noArtistSong')}}
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

