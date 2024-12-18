$( document ).ready(function(){
    $(document).on('click','.notification-icon',function(){
        $(".notification-dropdown").find(".notification-body").html('');
        $.ajax({
            url: get_notification_link,
            type: 'POST',
            beforeSend: function () {
                $('.notification-body').html('<a href="javascript:void(0)"><div class="media"><div class="media-body">Loading...</div></div></a>');
            },
            success: function(response) {
                $('.notification-body').html('');
                if(response != "" && response !== "undefined" && response != null && response.result !== "undefined" && response.result != null && response.result.length > 0){
                    var domElement = '';
                    $.each(response.result, function(k, v){
                        var created_at = moment(v.created_at,'YYYY-MM-DD HH:mm').format('DD/MM/YYYY, h:mm a');
                        domElement += '<a href="javascript:void(0)">'+
                        '<div class="media">'+
                            '<div class="media-body">'+
                                '<h6 class="media-heading">'+v.title+'</h6>'+
                                '<p class="notification-text font-small-3 text-muted">'+v.text+'</p>'+
                                '<small><time class="media-meta text-muted">'+created_at+'</time></small>'+
                            '</div>'+
                        '</div>'+
                    '</a>';
                    });
                    $('.notification-body').html(domElement);
                } else{
                    $('.notification-body').html('<a href="javascript:void(0)"><div class="media"><div class="media-body"><span class="font-small-3 text-muted">No Notification</span></div></div></a>');
                }
            },
        });
    });
});
