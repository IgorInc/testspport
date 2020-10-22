Dropzone.options.myDropzone = {
    url: "add_new_hero.php",
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 100,
    maxFiles: 1,
    maxFileSize: 1,
    acceptedFiles: "image/*",
    dictDefaultMessage: 'Чтобы добавить фото героя, перетащите изображение в это поле или просто кликните сюда',
    dictInvalidFileType: 'Можно загрузить только картинки',

    init: function () {

        var submitButton = document.querySelector("#submit_btn");
        var wrapperThis = this;

        submitButton.addEventListener("click", function (e) {
            e.preventDefault();
            if (wrapperThis.getQueuedFiles().length === 0) {
                var blob = new Blob();
                blob.upload = { 'chunked': wrapperThis.defaultOptions.chunking };
                wrapperThis.uploadFile(blob);

                //this.dropzone.processQueue();
            }
            console.log('Btn_click - отправляем данные.');
            wrapperThis.processQueue();
            return false;
        });

        this.on("success", function(file,response){
            $('#result').html(response);
            let page = {slider:1};
            console.log('DZ ОК.');
            getHeroes('.header_slider', page, 'get_heroes.php');
            //очищаем форму после успешной отправки
            $('#form_add_hero')[0].reset();
            wrapperThis.removeAllFiles();

            setTimeout(function(){
                $('#result').html('');
            },2000);
        });

        this.on("addedfile", function (file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn_del'>Удалить фото</button>");

            // Listen to the click event
            removeButton.addEventListener("click", function (e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                // Remove the file preview.
                wrapperThis.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });
        this.on('sending', function (data, xhr, formData) {
            formData.append("hero_name", $("#hero_name").val());
            formData.append("hero_title", $("#hero_title").val());
        });
/*
        this.on('sendingmultiple', function (data, xhr, formData) {
            formData.append("hero_name", $("#hero_name").val());
            formData.append("hero_title", $("#hero_title").val());
        });

 */
    }
};