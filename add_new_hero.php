<?php
//==================================
// подключаем необходимые файлы
//==================================
require_once 'config.php';
require_once 'DBClass.php';
$debug = true;
$path_log = $_SERVER['DOCUMENT_ROOT'].'/log_test.log';
file_put_contents($path_log,json_encode(['POST'=>$_POST], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
$db = new DBClass(SERVER,USER,PASS,DBNAME);

//столбцы таблицы
$mTableFields = 'NAME,TITUL,IMAGE,DATE_IN';

$mHero = [];

//==================================
// получаем данные	
//==================================
$mHero[0] = trim($_POST['hero_name']);
$mHero[1] = trim($_POST['hero_title']);
//добавить image
$mHero[2] = '';
$mHero[3] = date('Y-m-d');//date('Y-m-d', strtotime($_POST['birthday']));//date('Y.m.d',mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")-21));//getdate();//date('Y-m-d', strtotime($Date. ' -21 year'));//getdate();//date(strtotime("-21-$i year"));//date($curr_date[year]-21-$i);

if ($mHero[0]&&$mHero[1])
{	
	//Добавляем нового героя в таблицу HEROES
    file_put_contents($path_log,json_encode(['Ща будем добавлять'=>$mHero], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
	if ($result = $db->insert('heroes',$mHero,$mTableFields))
	{
		$message = "Успешно добавили нового героя.";
        // Формируем массив для JSON ответа
        file_put_contents($path_log,'Успешно добавили: '.$mHero[0].' с титулом '.$mHero[1].PHP_EOL,FILE_APPEND );

        /*
         $result = [
            "otvet"=>'Создан новый герой '. $_POST["hero_name"] . ' с титулом <'.$_POST["hero_title"].'>'
        ];*/
	}else{
		$message = "Ошибка БД. Не смогли добавить нового героя.";
        // Формируем массив для JSON ответа
        file_put_contents($path_log,'Ошибка БД. Не смогли добавить нового героя.'.PHP_EOL,FILE_APPEND );
        /*
        $result = [
            "otvet"=>'Ошибка БД. Не смогли добавить нового героя.'
        ];
        */
	}
    /* удаление выборки */
    mysqli_free_result($result);	
}else{
	$message = "Ошибка: не все поля заполнены.";
    file_put_contents($path_log,'Ошибка. Не все поля заполнены.'.PHP_EOL,FILE_APPEND );
    /*
    $result = [
        "otvet"=>'Ошибка. Не все поля заполнены.'
    ];
    */
}


// Переводим массив в JSON
//echo json_encode($result);
echo $message;
?>