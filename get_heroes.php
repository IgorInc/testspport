<?php
require_once 'config.php';
require_once 'DBClass.php';

$path_log = $_SERVER['DOCUMENT_ROOT'].'/log_test_GetHeroes.log';
file_put_contents($path_log,json_encode(['GetHeroes'=>'Получаем список героев'], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
$db = new DBClass(SERVER,USER,PASS,DBNAME);

$start = 0;//с какой строки будем выбирать данные из таблицы
$count = 4;//кол-во героев для показа в слайдере

//получаем запрос
$result = $db->select2('*','heroes');

if ($result) {
    //запоминаем текущую страницу
    $page = $_GET['slider_page'];

    $rows = mysqli_num_rows($result);//кол-во строк

    // Находим общее число страниц для слайдера
    $total = intval(($rows - 1) / $count) + 1;

    // Определяем начало сообщений для текущей страницы
    $page = intval($page);

    // Если в адресе ввели некорректный № страницы - исправляем
    if(empty($page) or $page < 0) $page = 1;
    if($page > $total) $page = $total;

    // Вычисляем, начиная к какого номера
    // следует выводить строки
    $start = $page * $count - $count;

    $result = $db->select2('*','users',null,null,$start.','.$count);

    // выводим данные из ассоциативного массива
    if ($result)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            //printf ("%s (%s)\n", $row["name"], $row["surname"],$row["account"]);
            echo '<tr>';
            echo '<td>' . $row["name"]    . '</td>';
            echo '<td>' . $row["surname"] . '</td>';
            echo '<td>' . $row["patronymic"] . '</td>';
            echo '<td>' . $row["birthday"] . '</td>';
            echo '<td>' . $row["account"] . '</td>';
            echo '<td>' . $row["amount"] . '</td>';
            echo '</tr>';
        }
    }

    /* подчищаем */
    mysqli_free_result($result);
}

?>
