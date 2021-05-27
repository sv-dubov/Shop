jQuery.noConflict(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('textarea[id="editor"]').summernote({
        lang: 'uk-UA',
        height: 300,
        callbacks: {
            /*
             * При вставке изображения загружаем его на сервер
             */
            onImageUpload: function(images) {
                for (var i = 0; i < images.length; i++) {
                    uploadImage(images[i], this);
                }
            },
            /*
             * При удалении изображения удаляем его на сервере
             */
            onMediaDelete: function(target) {
                removeImage(target[0].src);
            }
        }
    });
    /*
     * Загружает на сервер вставленное в редакторе изображение
     */
    function uploadImage(image, textarea) {
        var data = new FormData();
        data.append('image', image);
        $.ajax({
            data: data,
            type: 'POST',
            url: '/admin/page/upload/image',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.errors === undefined) {
                    $(textarea).summernote('insertImage', data.image, function ($img) {
                        $img.css('max-width', '100%');
                    });
                } else {
                    $.each(data.errors, function (key, value) {
                        alert(value);
                    });
                }
            },
        });
    }
    /*
     * Удаляет на сервере удаленное в редакторе изображение
     */
    function removeImage(src) {
        $.ajax({
            data: {'image': src, '_method': 'DELETE'},
            type: 'POST',
            url: '/admin/page/remove/image',
            cache: false,
            success: function(msg) {
                // console.log(msg);
            }
        });
    }
});
