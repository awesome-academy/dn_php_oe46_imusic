$.ajaxSetup({
    headers :{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var pusher = new Pusher('f13d1567ed35cc9f1d67', {
    encrypted: true,
    cluster: "ap1"
});

var channel = pusher.subscribe('NotificationEventSong');
var count = parseInt($('.cart-items').html())
channel.bind('send-message', function(data) {
    var newNotificationHtml = `
    <tr class="notif-count" id="detail-noti" data-id="${data['song'].id}" data-song="${data['song'].id}">
        <td class="product-pic">
            <a href="">
                <img src="/storage/${data['song'].image}" alt="">
            </a>
        </td>
        <td class="product-text">
            <a href="">
                <div class="product-info">
                 <p class="new-noti"> ${data['title']} <span>${data['song'].name}</span></p>
                    <h5>${data['time']}</h5>
                </div>
            </a>
        </td>
    </tr>

    `;
    count+=1;
    $('.cart-items').html(count);
    $('.new-notify').prepend(newNotificationHtml);
    detailSong()
});
function markAsRead()
{
    $('.notif-count').on('click', function(e){
    $(_this).addClass('read');
    e.preventDefault()
    var id = $(this).data('id')
    var _this = $(this);
    $.ajax({
        method :'POST',
        url :'song/markAsRead/'+id,
        success: function(data) {
            $('.cart-items').html(count)
            $(_this).addClass('read');
        }
    });
   });
}

markAsRead()

function detailSong() {
$('#detail-noti').on('click', function(e){
    var id = $(this).data('song');
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
                method: "POST",
                url   : '/add-lyric',
                data  : {
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
playMusic()
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
detailSong()
 $('.cart-box').on('click',function(e) {
    $(this).toggleClass('show');
    e.stopPropagation();
});

$(document).on('click', function(e) {
    if ($(e.target).is('.cart-box') === false) {
        $('.cart-box').removeClass('show');
    }
});
