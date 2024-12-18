if (typeof filter_enquiry_url === "undefined") { var filter_enquiry_url = ""; }
if (typeof delete_enquiry_url === "undefined") { var delete_enquiry_url = ""; }

$(function () {
    if($('.data-table').length){
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "GET",
                url: filter_enquiry_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'subject', name: 'subject' },
                { data: 'message', name: 'message' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class:"text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function() {
        var data_id = $(this).data("id");
        swal({
            title: "Delete enquiry",
            text: "Are you sure you want to delete this enquiry?",
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: delete_enquiry_url,
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
});
