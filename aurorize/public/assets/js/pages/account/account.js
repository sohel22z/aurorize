$(document).ready(function () {
    $(".account-form").validate({
        rules: {
            first_name: {required: true,normalizer:function(value){return $.trim(value)},alpha: true,minlength: 2,maxlength: 255},
            last_name: {required: true,normalizer:function(value){return $.trim(value)},alpha: true,minlength: 2,maxlength: 255},
            name: {required: true,normalizer:function(value){return $.trim(value)},alpha: true,minlength: 2,maxlength: 255},
            email: {required: true,normalizer:function(value){return $.trim(value)},email: false,maxlength: 255,checkEmail: true},
            profileImage: {required:false,normalizer:function(value){return $.trim(value)},extension: "jpg|jpeg|png",filesize: 500000},
        },
        messages: {
            first_name: {required: "Please enter a first name"},
            last_name: {required: "Please enter a last name"},
            name: {required: "Please enter a full name"},
            email: {required: "Please enter an email address",remote: "This email address already exists!"},
            profileImage: {required: "Please upload a image"},
        }
    });

    $(".account-update-password-form").validate({
        rules: {
            old_password: {required: true,normalizer:function(value){return $.trim(value)},minlength: 8,maxlength: 18},
            password: {required: true,normalizer:function(value){return $.trim(value)},minlength: 8,maxlength: 18},
            password_confirmation: {required: true,normalizer:function(value){return $.trim(value)},equalTo: "#password"}
        },
        messages: {
            old_password: {required: "Please enter a current password"},
            password: {required: "Please enter a new password"},
            password_confirmation: {required: "Please enter a confirm password",equalTo: "Please enter same password as above"}
        }
    });

    $(document).on('click','.upload-image .btn-upload',function(){
        $(".upload-image input").trigger('click');
    });

    $(document).on('change', '#profileImage', function(){
        readURL(this);
    });
});

function readURL(element) {
    var permitted = ['image/jpg','image/jpeg', 'image/png'];
    var custom_image_box = $(element).parents('.upload-image').find('.school-logo-box');
    var custom_image = $(element).parents('.upload-image').find('img');

    var file = element.files[0];
    custom_image.attr('src', custom_image.attr('data-src'));
    custom_image_box.removeClass('p-0');
    if( $(element).val() != "" && $(element).valid() ) {
        if($.inArray(file['type'], permitted ) > 0) {
            var img = new Image;
            img.onload = function() {
                var reader = new FileReader();
                reader.onload = function (e) { custom_image.attr('src', e.target.result); custom_image_box.addClass('p-0'); }
                reader.readAsDataURL(file);
            }
            img.src = window.URL.createObjectURL(file);
        }
    }
}