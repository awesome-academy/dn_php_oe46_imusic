
<div class="container-fluid">
    <div class="row row--grid">
        <div class="col-12">
            <div class="main__title main__title--page">
                <h1>{{$song->name}}</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="release">
                <div class="release__content">
                    <div class="release__cover">
                        <img src="/storage/{{$song->image}}" alt="" />
                    </div>
                    <div class="release__stat">
                        <span>
                           {{$song->view}}
                        </span>
                        <span>
                           <i class="fa fa-headphones" aria-hidden="true"></i>
                        </span>
                    </div>
                    <a href="#modal-buy" class="release__buy open-modal">{{$song->artist->name}}</a>
                </div>
                <div class="release__list" data-scrollbar="true" tabindex="-1">
                    <div class="scroll-content">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                             @foreach($cate_songs as $cate_song)
                            <li class="single-item">
                                <a class="single-item__cover">
                                    <img src="/storage/{{$cate_song->image}}" alt="" />
                                </a>
                                <div class="single-item__title">
                                    <h4><a href="#">{{$loop->index+1}}.{{$cate_song->name}}</a></h4>
                                    <span><a href="#">{{$cate_song->artist->name}}</a></span>
                                </div>
                                <a href="" data-id="{{ $cate_song->id }}" title="{{ trans('homePage.playSong') }}" class="single-item__add play play-music">
                                    <i class="far fa-play-circle icon-play"></i>
                                    <i class="far fa-pause-circle icon-pause"></i>
                                </a>
                                <span class="single-item__export more-option">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    <ul class="more-option-view">
                                        <li><a class="add-favorite-song" data-song ="{{ $cate_song->id }}" href=""><i class="fa fa-heart" aria-hidden="true"></i> Add to favorite</a></li>
                                        <li class="add-to-playlist"><a><i class="fa fa-plus-circle" aria-hidden="true"></i> Add to playlists</a>
                                            <ul class="sub-more">
                                                @if (Auth::check())
                                                @if (Auth::user()->playlists)
                                                    @foreach (Auth::user()->playlists as $item)
                                                        <li><a class="add-playlist-song" data-playlist=" {{ $item->id }}" data-song="{{ $cate_song->id }}" href="">
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
    </div>
    <div class="col-12 col-lg-8">
        <div class="article">
            <div class="article__content">
                <h4>@lang('home.lyris') </h4>
                   <div class="show_lyric"></div>
                   <span class="message"></span>
                  @if(isset($song->lyrics->content))
                  {!! $song->lyrics->content!!}
                  @else
                  <span class="formlyric">
                      Bạn có thể thêm lời bài hát
                     <span  id="formButton"><i class="fas fa-plus-circle"></i></span>
                        <form id="form1">
                          <b> {{$song->name}}</b>
                          <br>
                          <textarea name="content" class="content" cols="65" rows="5" required>
                          </textarea>
                          <br><br>
                          <button type="button" id="add_lyric" data-song
                          ="{{$song->id}}" data-user="{{ Auth::check() ? auth()->user()->id : ''}}">Thêm</button>
                        </form>
                  </span>
                  @endif
            </div>
            <div class="comments">
                <div class="comments__title">
                    <h4>Comments</h4>
                        <span>{{$countComment}}</span>
                    </div>
                    @foreach($comments as $comment)
                    <ul class="comments__list">
                        <li class="comments__item">
                            <div class="comments__autor">
                                <img class="comments__avatar" src="/storage/{{get_data_user('web','avatar')}}" alt="" />
                                <span class="comments__name">{{$comment->user->fullname}}</span>
                                <span class="comments__time">{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                            <p class="comments__text">
                              {{$comment->content}}
                            </p>
                            <div class="comments__actions">
                                <div class="comments__rate">
                                        @for($i = 1;$i <=5; $i++)
                                         <span class="list-inline-item">
                                             <i class="fas fa-star {{ $i > $comment->rate_star ? '' : 'text-warning'}} "></i>
                                        </span>
                                        @endfor

                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                    <span class="message1"></span>
                    <ul class="comments__list show_comment">
                    </ul>
                    <form class="comments__form">
                        <div class="rating">
                            <span><input type="radio" name="rate_star" id="str5" value="5"><label for="str5" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str4" value="4"><label for="str4" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str3" value="3"><label for="str3" class="fas fa-star"></label></span>
                            <span><input type="radio" name="rate_star" id="str2" value="2"><label for="str2" class="fas fa-star" ></label></span>
                            <span><input type="radio" name="rate_star" id="str1" value="1"><label for="str1" class="fas fa-star"></label></span>
                        </div>
                        <textarea type=""  id="_contend" name="content" class="comment_input" placeholder="Add comment"> </textarea>
                        <button type="submit" data-song = "{{$song->id}}" data-user="{{ Auth::check() ? auth()->user()->id : ''}}" class="sign__btn" id="submit_c">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

