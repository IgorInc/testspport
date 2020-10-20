Dropzone.options.myDropzone = {
    url: "/Account/Create",
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 100,
    maxFiles: 100,
    acceptedFiles: "image/*",
    dictDefaultMessage: 'Чтобы добавить фото героя, перетащите изображение в это поле или просто кликните сюда',

    init: function () {

        var submitButton = document.querySelector("#submit-all");
        var wrapperThis = this;

        submitButton.addEventListener("click", function () {
            wrapperThis.processQueue();
        });

        this.on("addedfile", function (file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Удалить фото</button>");

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

        this.on('sendingmultiple', function (data, xhr, formData) {
            formData.append("hero_name", $("#hero_name").val());
            formData.append("hero_title", $("#hero_title").val());
        });
    }
};