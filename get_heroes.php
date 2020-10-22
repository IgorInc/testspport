<?php
//Получаем геров для вывода в слайдер

require_once 'config.php';
require_once 'DBClass.php';

$path_log = $_SERVER['DOCUMENT_ROOT'].'/log_test_GetHeroes.log';
//file_put_contents($path_log,json_encode(['GetHeroes'=>'Получаем список героев','POST'=>$_POST,'GET'=>$_GET], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
$db = new DBClass(SERVER,USER,PASS,DBNAME);

$start = 0;//с какой строки будем выбирать данные из таблицы
$count = 4;//кол-во героев для показа в слайдере

//Проверяем, есть ли данные
$result = $db->select2('*','heroes');

if ($result) {
    file_put_contents($path_log,'Получили данные из БД. '.PHP_EOL,FILE_APPEND );
    //запоминаем текущую страницу
    $page = $_POST['slider'];
    $rows = mysqli_num_rows($result);//кол-во строк

    // Находим общее число страниц для слайдера
    $total = intval(($rows - 1) / $count) + 1;

    // Определяем начальную строку для текущей страницы
    $page = intval($page);

    // Если в адресе ввели некорректный № страницы - исправляем
    if(empty($page) or $page < 0) $page = 1;
    if($page > $total) $page = $total;

    // Вычисляем, начиная с какого номера
    // следует выводить строки: если row не кратно count, то берем последние 4 строки
    if ($rows - $page*$count >= 0)
        $start = $page * $count - $count;
    else
        $start = $rows - $count;

    $result = $db->select2('*','heroes',null,'ID DESC',$start.','.$count);

    // выводим данные из ассоциативного массива
    if ($result)
    {
        //file_put_contents($path_log,'Получили данные из БД (total='.$total.'). Ща будем выводить их. Страница='.$page.PHP_EOL,FILE_APPEND );
        $profile ='<div class="slider_heroes">';

        while ($row = mysqli_fetch_assoc($result))
        {
            $profile .='<div class="hero_profile">
                        <div class="hero_photo">
                            <img src="images/heroes/' .$row["IMAGE"]. '" alt="'.$row["NAME"]. '">
                        </div>
                        <div class="hero_info">
                            <div class="hero_name">'.$row["NAME"].'</div>
                            <div class="hero_prof">'.$row["TITUL"].'</div>
                        </div>
                        <div class="hero_date_in">
                            <p>Дата вступления в команду:</p>
                            <p>'.date('d.m.Y',strtotime($row["DATE_IN"])).'</p>
                        </div>
                    </div>';
            //file_put_contents($path_log,'Добавляем профиль: '.PHP_EOL.$profile.PHP_EOL,FILE_APPEND );
        }

        $profile .= '</div>';

        //Добавляем навигацию для слайдера
        $slider_nav = '';
        $i = 1;

        while($i <= $total){
            if ($i == $page)
                $slider_nav .= '<div class="slider_nav_dot active"></div>';
            else
                $slider_nav .= '<div class="slider_nav_dot"></div>';

            $i++;
        }

        if ($slider_nav) {
            $slider_nav = '<div class="slider_nav">' . $slider_nav . '</div>';
            $profile .= $slider_nav;
        }

        echo $profile;//отправляем, что насобирали
    }

    /* подчищаем */
    mysqli_free_result($result);
}

?>
