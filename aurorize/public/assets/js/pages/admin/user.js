if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }
if (typeof block_url === "undefined") { var block_url = ""; }
if (typeof view_url === "undefined") { var view_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }

$(function () {
    if($('.data-table').length){
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "GET",
                url: filter_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-white-space text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function() {
        var $button = $(this);
        var data_id = $(this).data("id");
        swal({
            title: "Delete user",
            text: "Are you sure you want to delete this user?",
            reverseButtons: true,
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: delete_url,
                    data: { id: data_id },
                    success: function(data) {
                        if (typeof data !== "undefined") {
                            if (typeof data.status !== "undefined" && data.status == true) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast("Oops! Something went wrong. Please try again.");
                        }
                    },
                    error: function(data) {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                });
            }
        });
    });

    $(document).on('click', '.block-unblock', function() {
        var _this = $(this);
        var data_id = $(this).data("id");
        var data_status = $(this).data("status");
        var title = (data_status == 1 ? "Activate user" : "Deactivate user");
        var text = (data_status == 1 ? "Are you sure you want to activate this user account?" : "Are you sure you want to deactivate this user account?");
        var btntext = (data_status == 1 ? "Yes, activate it" : "Yes, deactivate it");
        var status = (data_status == 1 ? 1 : 2);
        var data_title = (data_status != 1 ? "<i class='uil-lock'></i>" : "<i class='uil-unlock'></i>");
        data_status = (data_status == 1 ? 2 : 1);
        swal({
            title: title,
            text: text,
            reverseButtons: true,
            buttons: {
                confirm: { text: btntext, value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: block_url,
                    data: { id: data_id, status: status },
                    success: function(data) {
                        if (typeof data !== "undefined") {
                            if (typeof data.status !== "undefined" && data.status == true) {
                                successToast(data.message);
                                _this.data("status", data_status);
                                _this.html(data_title)
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast("Oops! Something went wrong. Please try again.");
                        }
                    },
                    error: function(data) {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                });
            }
        });
    });

    $(document).on('click', '.view', function() {
        var data_id = $(this).data("id");
        if (typeof data_id !== "undefined" && data_id != "") {
            $.ajax({
                type: "POST",
                url: view_url,
                data: { id: data_id },
                success: function(data) {
                    if (typeof data.data !== "undefined" && data.data != null) {
                        data = data.data;
                        $("#name").val(data.name);
                        $("#email").val(data.email);
                        $("#phone_number").val(data.phone_number);
                        $("#address_line1").val(data.address_line1);
                        $("#address_line2").val(data.address_line2);
                        $("#eircode").val(data.eircode);
                        $("#city").val(data.city);
                        $("#county").val(data.county);
                        $("#gender").val(data.gender == "M" ? "Male" : "Female");
                        $("#birthdate").val(moment(data.birthdate).format('DD/MM/YYYY'));

                        $("#viewuser").modal({ show: true });
                    } else {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                },
                error: function(data) {
                    errorToast("Oops! Something went wrong. Please try again.");
                }
            });
        }
    });

    $('#viewuser').on('hidden.bs.modal', function() {
        $('#viewuser').find('input, textarea').val('');
    });

    if (typeof validate !== 'function' && $.fn.validate) {
        $(".form-validate").validate({
            rules: {
                name: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    maxlength: 255,
                },
                email: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        data: {
                            id: $( 'input[name="id"]' ).val(),
                        }
                    },
                },
                phone_number: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    digits:true,
                    minlength: 7,
                    maxlength: 15,
                },
                photo:{
                    required: false,
                    normalizer: function(value) { return $.trim(value); },
                    extension: "png|jpg|jpeg",
                    filesize : 2000000,
                }
            },
            messages: {
                name: {
                    required: "Please enter a name",
                },
                email: {
                    required: "Please enter a email",
                    remote: "This email is already exists",
                },
                phone_number: {
                    required: "Please enter a phone number",
                },
                photo: {
                    required: "Please select a profile image",
                },
            }
        });
    }
});
