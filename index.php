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
                <div class="slider_heroes">
                    <div class="hero_profile">
                        <div class="hero_photo">
                            <img src="images/heroes/statham.png" alt="Джейсон Стейтем">
                        </div>
                        <div class="hero_info">
                            <div class="hero_name">Джейсон Стейтем</div>
                            <div class="hero_prof">Мастер ножей</div>
                        </div>
                        <div class="hero_date_in">
                            <p>Дата вступления в команду:</p>
                            <p>26.08.1967</p>
                        </div>
                    </div>
                    <div class="hero_profile">
                        <div class="hero_photo">
                            <img src="images/heroes/vandamm.png" alt="Ван Дамм">
                        </div>
                        <div class="hero_name">Ван Дамм</div>
                        <div class="hero_prof">Танцор</div>
                        <div class="hero_date_in">
                            <p>Дата вступления в команду:</p>
                            <p>18.10.1960</p>
                        </div>
                    </div>
                    <div class="hero_profile">
                        <div class="hero_photo">
                            <img src="images/heroes/stallone.png" alt="Сильвестр Сталлоне">
                        </div>
                        <div class="hero_name">Сильвестр Сталлоне</div>
                        <div class="hero_prof">Полуликий</div>
                        <div class="hero_date_in">
                            <p>Дата вступления в команду:</p>
                            <p>06.08.1946</p>
                        </div>
                    </div>
                    <div class="hero_profile">
                        <div class="hero_photo">
                            <img src="images/heroes/jet.png" alt="Джет Ли">
                        </div>
                        <div class="hero_name">Джет Ли</div>
                        <div class="hero_prof">Фанат Брюса</div>
                        <div class="hero_date_in">
                            <p>Дата вступления в команду:</p>
                            <p>27.02.1973</p>
                        </div>
                    </div>
                </div>
                <div class="slider_nav">
                    <div class="slider_nav_dot active"></div>
                    <div class="slider_nav_dot"></div>
                    <div class="slider_nav_dot"></div>
                </div>
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
                <form id="form_add_hero" class="hero_add_form"  name="add_hero" action="" method="post" enctype="multipart/form-data">
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
                        <p>Фото <abbr title="required">*</abbr></p>
                        <div id="myDropzone" class="dropzone" name="mainFileUploader">
                            <div class="fallback">
                                <label for="hero_file">Фото <abbr title="required">*</abbr></label>
                                <input type="file" id="hero_file" name="file">
                            </div>
                        </div>
                    </div>
                    <button id="submit_btn" class="btn_accept" type="submit">Принять</button>
                </form>
                <p id="result"></p>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="footer_block">
                <div class="copyright">
                    <span>ALL RIGHTS RESERVED. COPYRIGHT &copy CKDIGITAL</span>
                </div>
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
            </div>
        </div>
    </div>
</div>

</body>
</html>