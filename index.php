<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <meta name="description" content="Это описание сайта">
    <meta name="keywords" content="Тут ключевые слова для сайта">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/dropzone.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <script src="js/dropzone.min.js"></script>
    <script src="js/upload.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="container">
            <p class="title">
                <span class="slim">Моя</span><span class="bold"> супер команда</span>
            </p>
            <div class="delimiter_block">
                <div class="delimiter"></div>
                <div class="delimiter short"></div>
            </div>
            <div class="header_slider">
                <?include_once 'get_heroes.php'; ?>
            </div>
        </div>
    </div>

    <div class="middle dark_light">
        <div class="container">
            <div class="container_slim">
                <p class="title">
                    <span class="slim">Добавь своего</span><span> героя</span>
                </p>
                <div class="delimiter_block">
                    <div class="delimiter"></div>
                    <div class="delimiter short"></div>
                </div>
                <form id="form_add_hero" class="hero_add_form"  name="add_hero" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="input1">
                                <label for="hero_name">Имя <abbr title="required">*</abbr></label><br>
                                <input type="text" id="hero_name" name="hero_name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input2">
                                <label for="hero_title">Титул <abbr title="required">*</abbr></label><br>
                                <input type="text" id="hero_title" name="hero_title">
                            </div>
                        </div>
                    </div>
                    <div class="dropzone_block">
                        <p>Фото</p>
                        <div id="myDropzone" class="dropzone" name="mainFileUploader">
                            <div class="fallback">
                                <label for="hero_file">Фото <abbr title="required">*</abbr></label>
                                <input type="file" id="hero_file" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="btn_block">
                        <button id="submit_btn" class="btn_accept" type="submit">Принять</button>
                    </div>
                </form>
                <p id="result"></p>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="footer_block">
                <div class="links">
                    <a href="https://facebook.com" target="_blank">
                        <img src="images/links/facebook.png" alt="facebook">
                    </a>
                    <a href="https://twitter.com" target="_blank">
                        <img src="images/links/twitter.png" alt="twitter">
                    </a>
                    <a href="https://google.com" target="_blank">
                        <img src="images/links/google.png" alt="google">
                    </a>
                    <a href="https://linkedin.com" target="_blank">
                        <img src="images/links/linkedin.png" alt="linkedin">
                    </a>
                </div>
                <div class="copyright">
                    <span>ALL RIGHTS RESERVED. COPYRIGHT &copy CKDIGITAL</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>