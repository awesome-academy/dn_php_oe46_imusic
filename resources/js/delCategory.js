$(document).ready(function()
{
    $.ajaxSetup({
        headers :{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.del-cate-btn').on('click', function(){
        var option = confirm('Do you want to delete this category?');
        if (!option) {
        return;
        }
        var id = $(this).data('id')
        $.ajax({
        type:'DELETE',
        url: '/admin/categories/'+id,
        success: function(data)
        {
            $('#category-' + id).remove()
        }
        })
    });
    $('.del-album-btn').on('click', function(){
        var option = confirm('Do you want to delete this album?');
        if (!option) {
           return;
        }
        var id = $(this).data('id')
        $.ajax({
           type:'DELETE',
           url: '/admin/albums/'+id,
           success: function(data)
           {
               $('#album-' + id).remove();
           }
       })
    });
    $('.del-song-btn').on('click', function(){
        var option = confirm('Do you want to delete this song?');
            if (!option) {
            return;
            }
        var id = $(this).data('id')
        $.ajax({
            type:'DELETE',
            url: '/admin/songs/'+id,
            success: function(data)
            {
                $('#song-' + id).remove();
            }
        })
    });
});
