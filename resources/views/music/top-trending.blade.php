 <div class="container-fluid">
        <!-- title -->
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1 class="text-center">Top 100 Trending Music</h1>
                <div class="scroll-content" >
                    <ul class="main__list main__list justify-content-center">
                        @foreach($songs as $song)
                        <li class="single-item">
                            <a class="single-item__cover" >
                                <img src="/storage/{{ $song->image }}" alt="img">
                            </a>
                            <div class="single-item__title">
                                <h4 class="text-warning"><a href="#">{{$loop->index+1}}.{{$song->name}}</a></h4>
                                <span><a href="#">{{$song->view}}<i class="fas fa-headphones"></i></a></span>
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
                    </ul>
                </div>
        </div>
     </div>
</div>

