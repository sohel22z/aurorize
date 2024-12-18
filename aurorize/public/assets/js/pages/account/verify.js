$(function() {
    // Setup validation
    $(".verify-form-validate").validate({
        rules: {
            password: {required: true,minlength: 8,maxlength: 18},
            password_confirmation: {required: true,equalTo: "#password"},
        },
        messages: {
            password: {required: "Please enter a new password"},
            password_confirmation: {required: "Please enter a confirm new password",equalTo: "Please enter the same password as above"},
        },
    });
});
