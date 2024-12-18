if (typeof filter_url === "undefined") {
    var filter_url = "";
}
if (typeof delete_url === "undefined") {
    var delete_url = "";
}
if (typeof exists_url === "undefined") {
    var exists_url = "";
}

$(function () {
    if ($(".data-table").length) {
        var table = $(".data-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            // aaSorting: [],
            ordering: false,
            pageLength: 100,
            ajax: {
                type: "POST",
                url: filter_url,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    searchable: false,
                    orderable: false,
                    width: "50px",
                },
                { data: "name", name: "name" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                    class: "text-white-space text-center",
                },
            ],
        });
    }

    $(document).on("click", ".delete", function () {
        var $button = $(this);
        var data_id = $(this).data("id");
        swal({
            title: "Delete category",
            text: "Are you sure you want to delete this category?",
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: delete_url,
                    data: { id: data_id },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (
                                typeof data.status !== "undefined" &&
                                data.status == true
                            ) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast(
                                "Oops! Something went wrong. Please try again."
                            );
                        }
                    },
                    error: function (data) {
                        errorToast(
                            "Oops! Something went wrong. Please try again."
                        );
                    },
                });
            }
        });
    });

    if (typeof validate !== "function" && $.fn.validate) {
        $(".form-validate").validate({
            rules: {
                name: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    alphadash: true,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        data: {
                            id: $('input[name="id"]').val(),
                        },
                    },
                },
            },
            messages: {
                name: {
                    required: "Please enter a category name",
                    remote: "This category name is already exists!",
                },
            },
        });
    }
});
