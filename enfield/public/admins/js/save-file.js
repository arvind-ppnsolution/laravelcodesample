/* upload image */

var initDropforMultiUpload = function(id, width, height, _preload) {
    var file_up_names=[];
    var file_up_default_names=[];
    $(".upload_image" + id).dropzone({
        paramName: "image",
        maxFilesize: 200,
        url: uploadUrl,
        timeout: 9000000,
        uploadMultiple: false,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        //previewTemplate: '<i class="hidden preview-image"></i>',
        parallelUploads: 1,
        maxFiles: 10,
        init: function() {
            let myDropzone = this;
        if(existedImages){
            //console.log(existedImages);
            if(_preload){
            $.each(existedImages, function( index, value ) {
            // If the thumbnail is already in the right size on your server:
            let mockFile = { name: value };
            let callback = null; // Optional callback when it's done
            let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
            let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first
            myDropzone.displayExistingFile(mockFile, imgBaseUrl+'thumb-'+value, callback, crossOrigin, resizeThumbnail);
            $('#uploadedImageId').val('Exist');
            file_up_names.push(value);
            file_up_default_names.push(value);
        });
            // If you use the maxFiles option, make sure you adjust it to the
            // correct amount:
            let fileCountOnServer = existedImages.length; // The number of files already uploaded
            myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
    }
        }
          },
        
        success: function(file, data) {
            file_up_names.push(data.image);
            file_up_default_names.push(file.name);
            this.emit('thumbnail', file, data.thumb_image);
            $('#uploadedImageId').val('Exist');
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("width", width);
            formData.append("height", height);
            formData.append("id", $("#user_id").val());
        },
        removedfile: function(file) {
            x = confirm('Do you want to delete?');
            if(!x)  return false;
            for(var i=0;i<file_up_default_names.length;++i){

                if(file_up_default_names[i]==file.name) {
          
                    $.ajax({
                        url: removeUrl, //your php file path to remove specified image
                        type: "POST",
                        data: {
                            image: file_up_names[i],
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            id: $("#user_id").val(),
                        },
                        success: function(result){
                            return true;
                          }
                    });

                    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                 }
              }
              
              
        }
    });
};

var initDropforDocuments = function(id) {
    $(".upload_doc" + id).dropzone({
        paramName: "doc",
        maxFilesize: 200,
        url: uploadDocUrl,
        timeout: 9000000,
        uploadMultiple: false,
        acceptedFiles: "image/*,application/pdf",
        previewTemplate: '<i class="hidden preview-image"></i>',
        parallelUploads: 1,
        success: function(file, data) {
            $(".upload_doc" + id).prop('disabled', false);
            $(".upload_doc" + id)
                .parents(".form-group")
                .find(".uploadedFile")
                .find('a')
                .attr(
                    "href",
                    data.thumb_image
                );
                $(".upload_doc" + id)
                .parents(".form-group")
                .find(".uploadedFile")
                .find('a')
                .html(data.image);
                $(".upload_doc" + id).hide();
                $(".upload_doc" + id)
                .parents(".form-group")
                .find(".uploadedFile")
                .show();
            
        },
        uploadprogress: function(file, progress, bytesent) {
            $(".upload_doc" + id).prop('disabled', true);
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("id", $("#user_id").val());
        },
        error: function(file, data) {
            $(".upload_doc" + id).prop('disabled', false);
            var elm = $(this)[0].element;
            var _prt = $(".upload_doc" + id).parent(".form-group");
            //_prt.find('#image-progress').html('');
            _prt.find(".help-block").html("Image should be JPEG, PNG or JPG");
            jQuery.each(data.errors, function(i, _msg) {
                _prt.addClass("error");
                _prt.find(".help-block").html(_msg[0]);
            });
        }
    });
};

var initDropforUpdate = function(id, width, height) {
    $(".upload_image" + id).dropzone({
        paramName: "image",
        maxFilesize: 200,
        url: uploadUrl,
        timeout: 9000000,
        uploadMultiple: false,
        acceptedFiles: "image/*",
        previewTemplate: '<i class="hidden preview-image"></i>',
        parallelUploads: 1,
        success: function(file, data) {
            $(".upload_image" + id)
                .parents(".form-group")
                .find(".kt-avatar__holder")
                .attr(
                    "style",
                    "background-image: url(" + data.thumb_image + ")"
                );
            $("#user_image").val(data.image);
            /*if($('#user_id').val() == 'false'){
            $(".kt-header__topbar-item--user").find('img').attr('src',data.thumb_image);
            $(".kt-user-card__avatar").find('img').attr('src',data.thumb_image);
            }*/
        },
        uploadprogress: function(file, progress, bytesent) {
            //var elm = $(this)[0].element;
            var _prt = $(".upload_image" + id).parent(".form-group");
            //_prt.find('#image-progress').html(parseInt(progress) + '%');
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("width", width);
            formData.append("height", height);
            formData.append("id", $("#user_id").val());
            //formData.append("oldimage", $("#image"+id).val());
        },
        error: function(file, data) {
            var elm = $(this)[0].element;
            var _prt = $(".upload_image" + id).parent(".form-group");
            //_prt.find('#image-progress').html('');
            _prt.find(".help-block").html("Image should be JPEG, PNG or JPG");
            jQuery.each(data.errors, function(i, _msg) {
                //_prt.find('#image-progress').html('');
                //toastr.error(_msg[0]);
                _prt.addClass("error");
                _prt.find(".help-block").html(_msg[0]);
            });
        }
    });
};

var initDocDropforUpdate = function(id, width, height) {
    $(".upload_image" + id).dropzone({
        paramName: "image",
        maxFilesize: 200,
        url: uploadDocUrl,
        timeout: 9000000,
        uploadMultiple: false,
        acceptedFiles: "image/*,application/pdf",
        previewTemplate: '<i class="hidden preview-image"></i>',
        parallelUploads: 1,
        success: function(file, data) {
            //$(".upload_image"+id).parent('.form-group').find('#image-progress').html('');
            if (
                data.thumb_image.substr(
                    data.thumb_image.lastIndexOf(".") + 1
                ) == "pdf"
            )
                $(".upload_image" + id)
                    .parent(".form-group")
                    .find("img")
                    .attr(
                        "src",
                        data.thumb_image.replace(
                            data.image,
                            "pdf_thumbnail.png"
                        )
                    );
            else
                $(".upload_image" + id)
                    .parent(".form-group")
                    .find("img")
                    .attr("src", data.thumb_image);
            if ($("#user_id").val() == "false")
                $(".nav-user")
                    .find("img")
                    .attr("src", data.thumb_image);
        },
        uploadprogress: function(file, progress, bytesent) {
            //var elm = $(this)[0].element;
            var _prt = $(".upload_image" + id).parent(".form-group");
            //_prt.find('#image-progress').html(parseInt(progress) + '%');
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("width", width);
            formData.append("height", height);
            formData.append("id", $("#user_id").val());
            formData.append(
                "img_type",
                $(".upload_image" + id)
                    .parent(".form-group")
                    .find("#img_type")
                    .val()
            );
            //formData.append("oldimage", $("#image"+id).val());
        },
        error: function(file, data) {
            //var elm = $(this)[0].element;
            var _prt = $(".upload_image" + id).parent(".form-group");
            //_prt.find('#image-progress').html('');
            _prt.find(".help-block").html(
                "File should be JPEG, PNG, JPG or PDF"
            );
            jQuery.each(data.errors, function(i, _msg) {
                //toastr.error(_msg[0]);
                _prt.addClass("error");
                _prt.find(".help-block").html(_msg[0]);
            });
        }
    });
};

/*remove image*/
var removeImage = function(form, elm, id1) {
    var res = confirm("Are you sure, You want to remove this!");
    if (res) {
        var id = $(form)
            .find("#id")
            .val();
        var image = $("#image" + id1).val();
        axios({
            method: "post",
            url: removeUrl,
            data: "id=" + id + "&image=" + image
        })
            .then(function(response) {
                if (response.data) {
                    $(elm)
                        .parent()
                        .closest(".dropzone-button-controll")
                        .find("#dropzone_change_button")
                        .hide();
                    $(elm)
                        .parent()
                        .closest(".dropzone-button-controll")
                        .find("#dropzone_remove_button")
                        .hide();
                    $(elm)
                        .parent()
                        .closest(".dropzone-button-controll")
                        .find("#dropzone_select_button")
                        .show();
                    $(elm)
                        .parent()
                        .closest(".controls")
                        .find(".thumbnail")
                        .find("img")
                        .attr("src", placeholder);

                    $("#image" + id).val("");
                    //$("#image-progress").html('');
                    setTimeout(function() {
                        toastr.success(response.data.message);
                    }, 1000);
                }
            })
            .catch(function(error) {
                if (error.response) {
                    var message = error.response.data.message;
                    toastr.error(message);
                }
            });
        return false;
    }
};

var initDropforImport = function(role_id) {
    $(".bulk_import").dropzone({
        paramName: "file",
        maxFilesize: 200,
        url: bulkUploadUrl,
        uploadMultiple: false,
        timeout: 9000000,
        //acceptedFiles: 'image/*',
        previewTemplate: '<i class="hidden preview-image"></i>',
        parallelUploads: 1,
        success: function(file, data) {
            endLoader($(".bulk_import_btn"));
            toastr.success(data.message);
            setTimeout(function() {
                location.reload();
            }, 3000);
        },
        uploadprogress: function(file, progress, bytesent) {
            startLoader($(".bulk_import_btn"));
        },
        sending: function(file, xhr, formData) {
            var elm = $(this)[0].element;
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("role_id", role_id);
        },
        error: function(file, data) {
            endLoader($(".bulk_import"));
            toastr.error("File should be XLSX");
        }
    });
};
