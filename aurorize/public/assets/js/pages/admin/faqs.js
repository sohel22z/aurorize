if (typeof filter_faq_url === "undefined") { var filter_faq_url = ""; }
if (typeof delete_faq_url === "undefined") { var delete_faq_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }

$(function () {
    if($('.data-table').length){
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_faq_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'question', name: 'question' },
                { data: 'answer', name: 'answer' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-white-space text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function() {
        var $button = $(this);
        var data_id = $(this).data("id");
        swal({
            title: "Delete FAQ",
            text: "Are you sure you want to delete this FAQ?",
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: delete_faq_url,
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

    if (typeof validate !== 'function' && $.fn.validate) {
        $(".faqs-form-validate").validate({
            rules: {
                question: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    maxlength: 1000,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        data: {
                            id: $( 'input[name="id"]' ).val(),
                        }
                    },
                },
                answer: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    maxlength: 5000,
                },
            },
            messages: {
                question: {
                    required: "Please enter a question",
                    remote: "This question already exists",
                },
                answer: {
                    required: "Please enter an answer",
                },
            }
        });
    }
});
