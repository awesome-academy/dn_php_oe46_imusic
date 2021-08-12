$.ajaxSetup({
    headers :{
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var pusher = new Pusher('4aaba8a9d59bd11d0f02', {
    encrypted: true,
    cluster: "ap1"
});
var count_noti = Number($('.cart-items').html());
var channel = pusher.subscribe('AlbumNotifyEvent');
channel.bind('send-message', function(data) {
    var newNotificationHtml = `
    <tr class="notif-count" data-id="${data['album'].id}" data-album="${data['album'].id}">
        <td class="product-pic">
            <a>
                <img src="/storage/${data['album'].image}" alt="">
            </a>
        </td>
        <td class="product-text">
            <a>
                <div class="product-info">
                    <p class="new-noti">${data['title']}</p>
                    <h5 class="noti-name">${data['album'].name}</h5>
                    <p class="noti-time">${data['time']}</p>
                </div>
            </a>
        </td>
    </tr>
    `;
    count_noti += 1;
    $('.new-notify').prepend(newNotificationHtml);
    $('.cart-items').html(count_noti);
    readNotify();
});

function readNotify() {
    $('.notif-count').on('click', function(e) {
        e.preventDefault();
        var noti_id = $(this).data('id');
        var album = $(this).find('.product-info');
        var _this = $(this);
        if (count_noti > 0) {
            count_noti -= 1;
        } else {
            count_noti = 0;
        }
        $.ajax({
            type:'post',
            url: '/album/notification/'+noti_id,
            success: function(data)
            {
                $('.cart-items').html(count_noti);
                album.addClass('read');
                $(_this).addClass('read');
            }
        })
    });
}

readNotify();

$('.cart-box').on('click',function(e) {
    $(this).toggleClass('show');
    e.stopPropagation();
});

$(document).on('click', function(e) {
    if ($(e.target).is('.cart-box') === false) {
        $('.cart-box').removeClass('show');
    }
});
