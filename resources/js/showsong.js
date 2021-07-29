$.ajaxSetup({
    headers :{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.get_song').on('click', function () {
     var id = $(this).data('cate-id');
    $.ajax({
        method: 'GET',
        url: '/get-song-by-category/' + id,
        data : {'id' :id},
        success: function (data) {
            var html = '';
            var title = 'Song';
            Object.keys(data).forEach(key => {
                html += '<a class="box_music song-list" data-id = '+ data[key].id +' >' +
             '<img src="/storage/'+ data[key].image +'" alt="">'+
             '<h3>'+data[key].name+'</h3>'+
             '<h4>'+data[key].artist_name+'</h4>'+
             '</a>';
            });
            $('.title').html(title)
            $('.list_song').html(html);
            $('.song-list').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type:'get',
                    url: '/song/'+id,
                    success: function(data) {
                        $('#music-playing').html(data);
                        playMusicEvent();
                        detailSong();
                    }
                })
            });
        }
    });
});
function home()
{
    $('._home').click(function (e) {
    e.preventDefault()
    $.ajax({
        method :'GET',
        url:'/show-category',
        success : function(data) {
            var html = html1 =html2 = ''
            Object.keys(data['songs']).forEach(key => {
               html += '<a class="box_music song-list" data-id = '+ data['songs'][key].id +'>' +
             '<img src="/storage/'+ data['songs'][key].image +'" alt="">'+
             '<h3>'+data['songs'][key].name+'</h3>'+
             '<h4>'+data['songs'][key].artist_name+'</h4>'+
             '</a>';
            });

            Object.keys(data['artists']).forEach(key => {
               html1 += '<a class="box_music artist-detail" data-id= '+data['artists'][key].id+'href="#">' +
             '<img src="/storage/'+ data['artists'][key].image +'" alt="">'+
             '<h3>'+data['artists'][key].name+'</h3>'+
             '</a>';
            });
            Object.keys(data['albums']).forEach(key => {
               html2 += '<a class="box_music album-detail" data-id='+ data['albums'][key].id +' href="#">' +
             '<img src="'+data['albums'][key].image+'" alt="Death Cab fot Cutie">'+
             '<h3>'+data['albums'][key].name+'</h3>'+
             '</a>';
            });
            $('.list_song').html(html);
            $('.get_artist').html(html1);
            $('.get_album').html(html2);
            albumDetail()
            artislDetail()
            $('.song-list').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type:'get',
                url: '/song/'+id,
                success: function(data) {
                    $('#music-playing').html(data);
                    playMusicEvent();
                    detailSong();
                }
            })
        });
        }
    });

});
}
home()
$('._hotS').on('click', function (e) {
        e.preventDefault()
        var type = $(this).data('type')
        $.ajax({
            method: 'GET',
            url :'/hot/'+ type,
            success :function(data)
            {
                var html= '';
                if(type == "song")
                {
                    var title = "Song Hot"
                    Object.keys(data['songs']).forEach(key => {
                    html += '<a class="box_music song-list" data-id = '+ data['songs'][key].id +' >' +
                            '<img src="/storage/'+ data['songs'][key].image +'" alt="">'+
                            '<h3>'+data['songs'][key].name+'</h3>'+
                            '<h4>'+data['songs'][key].artist_name+'</h4>'+
                            '</a>';
                    });
                     $('.title').html(title)
                     $('.list_song').html(html);
                     $('.song-list').click(function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $.ajax({
                            type:'get',
                            url: '/song/'+id,
                            success: function(data) {
                                $('#music-playing').html(data);
                                playMusicEvent();
                                detailSong();
                                actionPlaylist();
                            }
                        })
                    });
                }else {
                    var title = "Album hot"
                    Object.keys(data['albums']).forEach(key => {
                    html += '<a class="box_music album-detail" data-id= '+ data['albums'].[key].id +'  href="">' +
                            '<img src="'+ data['albums'][key].image +'" alt="">'+
                            '<h3>'+data['albums'][key].name+'</h3>'+
                            '</a>';
                    });
                    $('.title').html(title)
                    $('.list_song').html(html);
                    albumDetail();
                       $('.song-list').click(function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $.ajax({
                            type:'get',
                            url: '/song/'+id,
                            success: function(data) {
                                $('#music-playing').html(data);
                                playMusicEvent();
                                detailSong();
                                actionPlaylist();
                            }
                        })
                    });
                }

            }
        })
    });
var isRepeat = false;
function playMusicEvent() {
    audio.play();
    var isPlaying = false;

    $('.play').click(function(e) {
        e.preventDefault();
        if (isPlaying) {
            audio.pause();
            $('.play').removeClass('playing');
        } else {
            audio.play();
            $('.play').addClass('playing');
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
}

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
        actionPlaylist()

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
                method        : "POST",
                url         : '/add-lyric',
                data        : {
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
                        $('.message').html('<div class="alert alert-danger" role="alert">' +'Thêm lời bài hát không thành công'
                        + '</div>');
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
            },error: function(reponses ,xhr, textStatus, thrownError) {
                 if(reponses.status == 401)
                   {
                    window.location = '/login'
                   }

                $('.message1').html('<div class="alert alert-danger" role="alert">' +'Đánh giá không thành công'
                    + '</div>');

            }
        });
        });
    }, error : (reponses)=> {
       if(reponses.status == 401)
       {
        window.location = '/login'
       }
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
            }
        })
    });
}
playMusic();

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
            },error : (reponses)=> {
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
            }
        });
    });
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
            home();

        }, error : (reponses)=> {
           if(reponses.status == 401)
           {
            window.location = '/login'
           }
        }
    });
})

}
function artislDetail ()
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
            home()
        }
    });
})
}
