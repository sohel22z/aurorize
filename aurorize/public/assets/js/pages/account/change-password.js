$(function() {
    // Setup validation
    $(".change-password-form-validation").validate({
        rules: {
            old_password: { required: true },
            password: {required: true,minlength: 8, maxlength: 18 },
            password_confirmation: {required: true,equalTo: "#password"},
        },
        messages: {
            old_password: {required: "Please enter a old password"},
            password: {required: "Please enter a new password"},
            password_confirmation: {required: "Please enter a confirm new password",equalTo: "Please enter the same password as above"},
        },
    });
});
