$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: "dd-mm-yyyy",
    maxViewMode: 1,
    todayBtn: "linked",
    language: "nl",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
});

$(document).ready(function () {
    $("#searchLog").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group a").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

tinymce.init({
    selector: 'textarea#content',
    height: 500,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table directionality emoticons paste code"
    ],
    menubar: "file | edit | view | format | tools",
    toolbar1: "undo redo | formats bold italic underline | alignleft aligncenter alignright alignjustify | table bullist numlist outdent indent | styleselect",
    toolbar2: "responsivefilemanager | link unlink anchor | image media | forecolor backcolor | preview code ",
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
    ],
    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    /* and here's our custom image picker*/
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/admin/upload/file');

        xhr.onload = function() {
            var json;

            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
});
