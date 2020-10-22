//Инициализация Dropzone - здесь отправляем ajax'ом данные формы
Dropzone.options.myDropzone = {
    url: "add_new_hero.php",
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 1,
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
            }

            wrapperThis.processQueue();
            return false;
        });

        this.on("success", function(file,response){
            $('#result').html(response);
            let page = {slider:1};

            //перевыводим слайдер с новым героем
            getHeroes('.header_slider', page, 'get_heroes.php');

            //очищаем форму после успешной отправки
            $('#form_add_hero')[0].reset();
            wrapperThis.removeAllFiles();

            //очищаем поле с сообщением
            setTimeout(function(){
                $('#result').html('');
            },2000);
        });

        this.on("addedfile", function (file) {
            //Чтобы юзер не смог закинуть неск фоток - оставляем только одну
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }

            //Добавляем кнопку для удаления фото
            var removeButton = Dropzone.createElement("<button class='btn_del'>Удалить фото</button>");

            removeButton.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                wrapperThis.removeFile(file);
            });

            file.previewElement.appendChild(removeButton);
        });

        //добавляем данные формы, чтобы получить в $_POST
        this.on('sending', function (data, xhr, formData) {
            formData.append("hero_name", $("#hero_name").val());
            formData.append("hero_title", $("#hero_title").val());
        });

    }
};