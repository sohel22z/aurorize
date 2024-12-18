if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }
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
                url: filter_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'title', name: 'title' },
            /*   { data: 'image', name: 'image' },
                { data: 'description', name: 'description' }, */
                { data: 'action', name: 'action', orderable: false, searchable: false,className:"text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function() {
        var data_id = $(this).data("id");
        swal({
            title: "Delete blog",
            text: "Are you sure you want to delete this blog?",
            buttons: {
                confirm: { text: "Yes, delete it", value: true, visible: true, className: "btn-danger", closeModal: true, },
                cancel: { text: "No", value: null, visible: false, className: "", closeModal: true, },
                close: { text: "", value: null, visible: true, className: "swal2-close", closeModal: true, },
            },
        }).then(isConfirm => {
            if (isConfirm) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('blogid', data_id),
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

    if ($("#description").length) {
        const editor = CKEDITOR.replace("description", {
            height: "350px",
            toolbarGroups: [
                { name: "styles", groups: ["styles"] },
                {
                    name: "paragraph",
                    groups: [
                        "list",
                        "indent",
                        "blocks",
                        "align",
                        "bidi",
                        "paragraph",
                    ],
                },
                { name: "insert", groups: ["insert"] },
                { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
                { name: "colors", groups: ["colors"] },
                { name: "clipboard", groups: ["clipboard", "undo"] },
                {
                    name: "editing",
                    groups: ["find", "selection", "spellchecker", "editing"],
                },
                { name: "forms", groups: ["forms"] },
                { name: "links", groups: ["links"] },
                { name: "document", groups: ["mode", "document", "doctools"] },
            ],
            removeButtons:
                "Save,Language,Templates,NewPage,Preview,Print,Replace,Find,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,Iframe,Font,About",
            image_previewText: " ",
            removeDialogTabs: "image:advanced;image:Link",
            filebrowserUploadUrl: imageuploadurl,
            filebrowserUploadMethod: "form",
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
        $(".blog-form-validate").validate({
            rules: {
                title: {
                    required: true,
                    normalizer: function(value) { return $.trim(value); },
                    alphadash:true,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        data: {
                            id: $( 'input[name="id"]' ).val(),
                        }
                    },
                },
                image: {
                    required: {
                        depends: function () {
                            if($("#old_image").length && $("#old_image").val() != ""){
                                return false;
                            }
                            return true;
                        }
                    },
                    normalizer: function(value) { return $.trim(value); },
                    extension: "png|webp|jpg|jpeg",
                    filesize : 2000000,

                },
                description : {
                    required: function(){
                        CKEDITOR.instances.description.updateElement();
                        var editorcontent = $('#description').val().replace(/<[^>]*>/gi, ''); // strip tags
                        var editor_value = $.trim(editorcontent.replace(/&nbsp;/g, ''));
                        return Number(editor_value) === 0;
                    },
                    normalizer: function(value) { return $.trim(value); },
                    checkCkeditorEmpty: '#description',
                },
            },
            messages: {
                title: {
                    required: "Please enter a title",
                    remote: "This title already exists!",
                },
                image: {
                    required: "Please select an image",
                    filesize: "File size must be less than or equal to 2MB",
                },
                description: {
                    required: "Please enter a description",
                },
            }
        });
    }
});
