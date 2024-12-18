if (typeof filter_email_url === "undefined") { var filter_email_url = ""; }
if (typeof delete_email_url === "undefined") { var delete_email_url = ""; }

$(function () {
    if($('.data-table').length){
        var table = $('.data-table').DataTable({
            "pageLength": 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_email_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'title', name: 'title' },
                { data: 'subject', name: 'subject' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class:"text-center" },
            ]
        });
    }
    
    $(document).on('click', '.delete', function() {
        var data_id = $(this).data("id");
        swal({
            title: "Delete email",
            text: "Are you sure you want to delete this email?",
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: delete_email_url,
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

    if($("#body").length){
        const editor = CKEDITOR.replace('body', {
            height: '300px',
            toolbarGroups: [
                { name: 'styles', groups: [ 'styles','Format','FontSize' ] },
                //{ name: 'editing', groups: ['find', 'selection'] },
                //{ name: 'tools', groups: [ 'tools' ] },
                { name: 'basicstyles', groups: ['basicstyles'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                //{ name: 'clipboard', groups: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo' ] },
                { name: 'links' },
                //{ name: 'insert', groups: [ 'insert' ]},
                { name: 'colors', groups: [ 'TextColor', 'BGColor' ] },
                { name: 'others' },
                { name: 'mode' },
            ],
            removeButtons:'Font, Image,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe',
        });
        editor.on( 'change', function( evt ) {
            // const data = editor.getData();
            const element = evt.editor.name;
            CKEDITOR.instances[element].updateElement();
            $("[name="+element+"]").trigger('blur');
        });
    }

    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".email-form-validate").validate({
            rules: {
                title: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255
                },
                subject: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255
                },
                body: {
                    required: function(){
                        CKEDITOR.instances.body.updateElement();
                        var editorcontent = $('#body').val().replace(/<[^>]*>/gi, ''); // strip tags
                        var editor_value = $.trim(editorcontent.replace(/&nbsp;/g, ''));
                        return Number(editor_value) === 0;
                    },
                    normalizer: function(value) { return $.trim(value); },
                    checkCkeditorEmpty: '#body',
                },
            },
            messages: {
                title: {
                    required: "Please enter a Email Title",
                    alpha: "The Email Title may only contain letters and spaces.",
                    minlength: jQuery.validator.format("At least {0} characters required"),
                    maxlength: jQuery.validator.format("Maximum {0} characters allowed")
                },
                subject: {
                    required: "Please enter a Email Subject",
                    alpha: "The Email Subject may only contain letters and spaces.",
                    minlength: jQuery.validator.format("At least {0} characters required"),
                    maxlength: jQuery.validator.format("Maximum {0} characters allowed")
                },
                body: {
                    required: "Please enter a Email Body content",
                },
            },
        });
    }
});
