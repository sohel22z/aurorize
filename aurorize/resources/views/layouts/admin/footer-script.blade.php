<script src="{{ Helper::assets('assets/js/vendor.min.js') }}"></script>
@yield('script')
<script>var assetUrl="{{Helper::assets('assets/')}}";</script>
<script src="{{ Helper::assets('assets/js/app.min.js') }}"></script>
<script src="{{ Helper::assets('assets/js/custom.js') }}"></script>

@yield('script-bottom')

{{-- @if(isset($notificationjs) && $notificationjs)
<script defer type="text/javascript">
    $(document).ready(function() {
        console.log("fsfsf")
        if ($('.noti-list').length) {
            $(document).on('click hover', '.noti-icon', function() {
                $(".noti-list").find(".noti-body").html('');
                $.ajax({
                    url: "{{ route('user.notifications') }}",
                    type: 'POST',
                    beforeSend: function() {
                        $('.noti-body').html('<a href="javascript:void(0)" class="dropdown-item notify-item">Loading...</a>')
                    },
                    success: function(response) {
                        $('.noti-body').html('');
                        if (response != "" && typeof response !== "undefined" && response.status == 1 && response.result !== "undefined" && response.result.length) {
                            var domElement = '';
                            $.each(response.result, function(k, v) {
                                var redirect_url = "javascript:;";
                                if (v.redirect_on != null) {
                                    // if (v.type == 9 || v.type == 14) {
                                    //     redirect_url = schoolUrl.replace('ids', v.redirect_on)
                                    // }
                                }
                                domElement += '<a href="'+redirect_url+'" class="dropdown-item notify-item border-bottom"><p class="notify-details ml-0">' + v.text + '<small class="text-muted opacity8 notify-time">' + v.created_at + '</small></p></a>';
                            });
                            $('.noti-body').html(domElement);
                            $(".noti-icon-badge").remove()
                        } else {
                            $('.noti-body').html('<a href="javascript:void(0)" class="dropdown-item notify-item">No notification found</a>')
                        }
                    }
                })
            })
        }
    })
</script>
@endif --}}
