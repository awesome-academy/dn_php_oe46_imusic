$.ajaxSetup({
    headers :{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function playSong() {
    $('.song-list').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type:'get',
            url: '/song/'+id,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
                detailSong();
                actionPlaylist()
            }
        })
    });
}

playSong();


function detailSong() {
    $('.detail-song').on('click', function(e){
        var id = $(this).data('song-detail');
        e.preventDefault()
        $.ajax({
            method:'GET',
            url:'detail-song/'+id,
            success: function(data) {
            $('#profile').html(data);
            playMusic()
            actionPlaylist();

            $("#formButton").click(function(evt) {
                 evt.preventDefault();
                    $("#form1").toggle();
            });
            $('#add_lyric').on('click', function(e){
               e.preventDefault();
               var song_id = $(this).data('song');
               var content = $('.content').val();
               var user_id = $(this).data('user');
                 $.ajax({
                    method : "POST",
                    url    : '/add-lyric',
                    data   : {
                    'song_id': song_id,
                    'content':content,
                    'user_id':user_id,
                    '_token': $('input[name=_token]').val()},
                    success: function(data){
                        var html=''
                        html = '<span class="content_lyric">'+data.lyric.content+'</span>'+
                        '<br>'+
                        '<span class="content_lyric"> Người thêm lời :'+ data.lyric.user.fullname+' </span>';

                        $('.message').html('<div class="alert alert-success" role="alert">' + data.message
                        + '</div>');
                        $('.show_lyric').append(html);
                        $('.formlyric').hide();
                    }, error: function( reponses ,xhr, textStatus, thrownError) {
                       if(reponses.status == 401)
                       {
                        window.location = '/login'
                       }

                    }

                })

            });

            $(".rating input:radio").attr("checked",false);

            $('.rating input').click(function () {
                $(".rating span").removeClass('checked');
                $(this).parent().addClass('checked');
            });

            var star;
            $('input:radio').change(
                function(){
                star = this.value;
            });
            $('#submit_c').on('click', function(evt){
            evt.preventDefault();
            var song_id = $(this).data('song');
            var content = $('#_contend').val();
            var user_id = $(this).data('user');
            $.ajax({
                method: "POST",
                url   : '/song-comment',
                data  : {
                'song_id': song_id,
                'rate_star':star,
                'content':content,
                'user_id':user_id,
                '_token': $('input[name=_token]').val()},
                success: function(data){
                   var html =''
                   var formattedDate = new Date(data.comment.created_at);
                   var d = formattedDate.getDate();
                   var m =  formattedDate.getMonth();
                   m += 1;
                   var y = formattedDate.getFullYear();
                   var result = d + "-" + m + "-" + y;
                   var star = ''
                   for(var i = 1 ;i <= 5 ;i++)
                   {
                        if (i > data.comment.rate_star) {
                            star +='<span class="list-inline-item">'+
                                   '<i class="fas fa-star">'+'</i>'+
                                   '</span>';

                        } else {
                            star +='<span class="list-inline-item">'+
                                   '<i class="fas fa-star text-warning ">'+'</i>'+
                                   '</span>';
                        }
                   }
                   html =  '<li class="comments__item">'+
                            '<div class="comments__autor">'+
                                '<img class="comments__avatar" src="/storage/data.comment.user.avatar" alt="" />'+
                                '<span class="comments__name">'+data.comment.user.fullname+'</span>'+
                                '<span class="comments__time">'+result+'</span>'+
                            '</div>'+
                            '<p class="comments__text">'+
                               data.comment.content +
                            '</p>'+
                            '<div class="comments__actions">'+
                               ' <div class="comments__rate">'+
                                       star
                                    '</span>'+
                                '</div>'+
                            '</div>'+
                        '</li>';
                $('.message1').html('<div class="alert alert-success" role="alert">' + data.message
                        + '</div>');
                $('.show_comment').prepend(html)
                $('#_contend').val("");
                $(".rating span").removeClass('checked');
                },error: function( reponses ,xhr, textStatus, thrownError) {
                   if(reponses.status == 401)
                   {
                    window.location = '/login'
                   }
                    $('.message1').html('<div class="alert alert-danger" role="alert">' +'Đánh giá không thành công'
                    + '</div>');
                }
            });
            });
        }
    });
    });
}

function playMusic() {
    $('.play-music').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type:'get',
            url: '/song/'+id,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
                actionPlaylist();
                detailSong();
            }
        })
    });
}
playMusic();

var isRepeat = false;
function playMusicEvent() {
    audio.play();
    var isPlaying = false;

    $('.play').click(function(e) {
        e.preventDefault();
        if (isPlaying) {
            audio.pause();
            $(this).removeClass('playing');
        } else {
            audio.play();
            $(this).addClass('playing');
        }
    });

    audio.onplay = function() {
        isPlaying = true;
    }

    audio.onpause = function() {
        isPlaying = false;
    }

    audio.ontimeupdate = function() {
        if (audio.duration) {
            var progressPercent = Math.floor(audio.currentTime / audio.duration *100);
            $('#progress').val(progressPercent);
            var currentTimeAudio = convertTime(Math.floor(audio.currentTime));
            $('.current-time').html(currentTimeAudio);
            var durationAudio = convertTime(Math.floor(audio.duration));
            $('.audio-duration').html(durationAudio);
        }
    }

    progress.onchange = function (e) {
        var seekTime = audio.duration / 100 * e.target.value
        audio.currentTime = seekTime
    }

    $('#volProgress').on('input', function () {
        audio.volume = $(this).val();
    });

    $('.next-song').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nextIndex = ++id;

        $.ajax({
            type:'get',
            url: '/song/'+nextIndex,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
            }
        })
    });

    $('.prev-song').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (id == 1) {
            var prevIndex = 1;
        } else {
            var prevIndex = --id;
        }

        $.ajax({
            type:'get',
            url: '/song/'+prevIndex,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
            }
        })
    });

    audio.onended = function() {
        $('.next-song').click();
    }

    $('.repeat-song').click(function(e) {
        e.preventDefault();
        if(!isRepeat) {
            $(this).addClass('active');
            isRepeat = true;
            audio.onended = function() {
                audio.play();
            }
        } else {
            $(this).removeClass('active');
            isRepeat = false;
            audio.onended = function() {
                $('.next-song').click();
            }
        }
    });

    $('.random-song').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
    });

    function convertTime(sec) {
        var hours = Math.floor(sec/3600);
            (hours >= 1) ? sec = sec - (hours*3600) : hours = '00';
        var min = Math.floor(sec/60);
            (min >= 1) ? sec = sec - (min*60) : min = '00';
            (sec < 1) ? sec='00' : void 0;

            (min.toString().length == 1) ? min = '0'+min : void 0;
            (sec.toString().length == 1) ? sec = '0'+sec : void 0;

        if (hours == '00') {
            return min + ':' + sec;
        } else {
            return hours + ':' + min + ':' + sec;
        }
    }
}


$('.btn_playlist').click(function(e) {
    e.preventDefault();

    $.ajax({
        type:'get',
        url: '/create-playlists',
        success: function(data)
        {
            $('.box_main').html(data);
            submitForm();
        }, error : (reponses)=> {
           if(reponses.status == 401)
           {
            window.location = '/login'
           }
        }
    });
});

function addAlbumPlaylist() {
    $('.add-album-btn').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            type:'post',
            url: '/add-album/'+id,
            success: function(data)
            {

                $('.add-album-btn').addClass('active');
                $(".playlist").load(location.href+" .playlist>*","");
                playlistSong();
            }, error : (reponses)=> {
               if(reponses.status == 401)
               {
                window.location = '/login'
               }
            }
        });
    });
}

$('.manage-playlist').click(function(e) {
    e.preventDefault();

    $.ajax({
        type:'get',
        url: '/playlists',
        success: function(data)
        {
            $('.box_main').html(data);
            playlistSong();
        },error : (reponses)=> {
           if(reponses.status == 401)
           {
            window.location = '/login'
           }
        }
    });
});

function submitForm() {
    $('#create-playlist').submit(function(e) {
        e.preventDefault();
        var name = $('#playlist-name').val();
        $.ajax({
            type:'post',
            url: '/store-playlists',
            data: {
                name: name,
            },
            success: function(data)
            {
                $('.box_main').html(data);
                $(".playlist").load(location.href+" .playlist>*","");
                playlistSong();
            }
        });
    });
}

function playlistSong() {
    $('.play-playlist').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type:'get',
            url: '/playlist-detail/' + id,
            success: function(data)
            {
                $('.box_main').html(data);
                actionPlaylist();
                showSongList();
                playMusic();
            }
        })
    });

    $('.play-favAlbum').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type:'get',
            url: '/favorite-album/' + id,
            success: function(data)
            {
                $('.box_main').html(data);
                actionPlaylist();
                playMusic();
            }
        })
    });

    $('.del-playlist').click(function() {
        var option = confirm('Are you sure you want to delete this playlist?');
        if (!option) {
            return;
        }
        var id = $(this).data('id');
        $.ajax({
            type:'post',
            url: '/del-playlist/' + id,
            success: function(data)
            {
                $('#playlist-' + id).remove();
                $(".playlist").load(location.href+" .playlist>*","");
            }
        })
    });

    $('.del-favAlbum').click(function() {
        var option = confirm('Are you sure you want to delete this playlist?');
        if (!option) {
            return;
        }
        var id = $(this).data('id');
        $.ajax({
            type:'post',
            url: '/del-fav-album/' + id,
            success: function(data)
            {
                $('#playlist-' + id).remove();
                $(".playlist").load(location.href+" .playlist>*","");
            }
        });
    });
}

function showSongList() {
    $('.add-song-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type:'get',
            url: '/song-list/' + id,
            success: function(data)
            {
                $('.box_main').html(data);
                searchSong();
            }
        });
    });
}

function searchSong() {
    $('#search-song').on('input', function() {
        var playlistId = $(this).data('id');
        var search = $(this).val();

        $.ajax({
            type:'post',
            url: '/playlist/' + playlistId + '/search/' + search,
            success: function(data)
            {
                $('#song-search').html(data);
                actionPlaylist();
            }
        });
    });
}

function actionPlaylist()
{
    $('.add-favorite-song').click(function(e) {
        e.preventDefault();
        var song = $(this).data('song');
        $.ajax({
            type:'post',
            url: '/favorite-song/' + song,
            success: function(data)
            {
                $(".playlist").load(location.href+" .playlist>*","");
            }, error : (reponses)=> {
               if(reponses.status == 401)
               {
                window.location = '/login'
               }
           }
        });
    });

    $('.add-playlist-song').click(function(e) {
        e.preventDefault();
        var playlistId = $(this).data('playlist');
        var song = $(this).data('song');

        $.ajax({
            type:'post',
            url: '/playlist/' + playlistId + '/song/' + song,
            success: function(data)
            {
                $('#song-' + song).remove();
            }, error : (reponses)=> {
                       if(reponses.status == 401)
                       {
                        window.location = '/login'
                       }
                    }
        });
    });

    $('.del-playlist-song').click(function(e) {
        e.preventDefault();
        var playlistId = $(this).data('playlist');
        var song = $(this).data('song');

        $.ajax({
            type:'post',
            url: '/playlist/' + playlistId + '/del-song/' + song,
            success: function(data)
            {
                $('#songItem-' + song).remove();
            }
        });
    });
}

playlistSong();

$('#search-form').submit(function(e) {
    e.preventDefault();
    var search = $('#search').val();
        $.ajax({
            type:'get',
            url: '/search/' + search,
            success: function(data)
            {
                $('.box_main').html(data);
                playSong();
                searchMore();
                albumDetail();
                artistDetail();
            }
        });
});

function searchMore() {
    $('.search-more').click(function() {
        var type = $(this).data('type');
        var search = $(this).data('search');
        $.ajax({
            type:'get',
            url: '/search/' + type + '/key/' + search,
            success: function(data)
            {
                $('.box_main').html(data);
                paginate(type, search);
                playSong();
                albumDetail();
                artistDetail();
            }
        });
    });
}

function paginate(type, search) {
    $('.pagination a').unbind('click').on('click', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPosts(page);
    });

    function getPosts(page) {
        $.ajax({
            type: 'get',
            url: '/search/' + type + '/key/' + search + '?page='+ page,
            success: function(data)
            {
                $('.box_main').html(data);
                paginate(type, search);
                playSong();
                albumDetail();
                artistDetail();
            }
        });
    }
}

function albumDetail ()
{
    $('.album-detail').click(function(e) {
    e.preventDefault();
    var album = $(this).data('id');

    $.ajax({
        type: 'get',
        url: '/album-detail/'+ album,
        success: function(data)
        {
            $('.box_main').html(data);
            addAlbumPlaylist();
            playMusic();
            actionPlaylist();
            topTren();
        }
    });
})

}
function artistDetail()
{
    $('.artist-detail').click(function(e) {
    e.preventDefault();
    var artist = $(this).data('id');

    $.ajax({
        type: 'get',
        url: '/artist-detail/'+ artist,
        success: function(data)
        {
            $('.box_main').html(data);
            addAlbumPlaylist();
            playMusic();
            actionPlaylist();
            topTren();
        }
    });
})
}
albumDetail();
artistDetail();


function topTren()
{
    $('.top_tren').on('click', function(e){
    e.preventDefault()
    $.ajax({
        method:'GET',
        url :'/top-trending-song',
        async: false,
        success: function (data) {
            $('.box_main').html(data);
            playMusic();
            actionPlaylist();
        }
    })
});

}
topTren();

