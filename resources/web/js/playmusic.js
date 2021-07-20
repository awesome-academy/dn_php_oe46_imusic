$(document).ready(function() {
    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.song-list').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type:'get',
            url: '/'+id,
            success: function(data)
            {
                $('#music-playing').html(data);
                playMusicEvent();
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
                url: '/home/'+nextIndex,
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
                url: '/home/'+prevIndex,
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
});
