$(document).ready(function() {

    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-album-song').click(function(e) {
        e.preventDefault();
        var album = $(this).data('album');
        var song = $(this).data('song');
       
        $.ajax({
            method:'get',
            url: '/admin/albums/'+album+'/add-song/'+song,
            success: function(data)
            {   
                $('#song-' + song).remove();
            }
        })
    })

    $('.del-album-song').click(function(e) {
        var album = $(this).data('album');
        var song = $(this).data('song');
       
        $.ajax({
            type:'get',
            url: '/admin/albums/' + album + '/del-song/' + song,
            success: function(data)
            {   
                $('#song-' + song).remove();
            }
        })
    })
});
