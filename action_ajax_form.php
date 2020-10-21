<?php
if (isset($_POST["hero_name"]) && isset($_POST["hero_title"]) ) {

    // Формируем массив для JSON ответа
    $result = [
        'otvet'=>'Создан новый герой: '. $_POST["hero_name"] . ' с титулом <'.$_POST["hero_title"].'>'
    ];

    // Переводим массив в JSON
    echo json_encode($result);
}

?>
