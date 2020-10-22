<?php
//==================================
// подключаем необходимые файлы
//==================================
require_once 'config.php';
require_once 'DBClass.php';

$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/images/heroes/';

$path_log = $_SERVER['DOCUMENT_ROOT'].'/log_test.log';//для тестирования
//file_put_contents($path_log,json_encode(['POST'=>$_POST,'FILES'=>$_FILES,'dataDZ'=>$data], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
$db = new DBClass(SERVER,USER,PASS,DBNAME);

//столбцы таблицы
$mTableFields = 'NAME,TITUL,IMAGE,DATE_IN';

$mHero = [];

//==================================
// получаем данные	
//==================================
$mHero[0] = htmlspecialchars( strip_tags(trim($_POST['hero_name'])) );
$mHero[1] = htmlspecialchars( strip_tags(trim($_POST['hero_title'])) );

if(!empty($_FILES) && $_FILES['file']['size'] > 0) {
    $info = htmlspecialchars( strip_tags($_FILES['file']['name']) );
    $info = pathinfo($info);

    //делаем имя файла уникальным
    $upload_file_name = uniqid(basename($_FILES['file']['name'], '.' . $info['extension'])) . '.' . $info['extension'];
    $upload_file = $upload_dir . $upload_file_name;

    //file_put_contents($path_log,'Переносим файл: '. $upload_file .PHP_EOL,FILE_APPEND );
    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_file))
        $upload = true;
    else
        $upload = false;

    $mHero[2] = $upload_file_name; //basename($_FILES['file']['name']);//'jet.png';
}else {
    $mHero[2] = 'noimage.png';
}

$mHero[3] = date('Y-m-d');

if ($mHero[0]&&$mHero[1])
{	
	//Добавляем нового героя в таблицу HEROES
    //file_put_contents($path_log,json_encode(['Ща будем добавлять'=>$mHero], JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE).PHP_EOL,FILE_APPEND );
	if ($result = $db->insert('heroes',$mHero,$mTableFields))
	{
		$message = "Успешно добавили нового героя.";
        //file_put_contents($path_log,'Успешно добавили: '.$mHero[0].' с титулом '.$mHero[1].PHP_EOL,FILE_APPEND );
	}else{
		$message = "Ошибка БД. Не смогли добавить нового героя.";
        //file_put_contents($path_log,'Ошибка БД. Не смогли добавить нового героя.'.PHP_EOL,FILE_APPEND );
	}
    /* удаление выборки */
    mysqli_free_result($result);	
}else{
	$message = "Ошибка: не все поля заполнены.";
    //file_put_contents($path_log,'Ошибка. Не все поля заполнены.'.PHP_EOL,FILE_APPEND );
}

echo $message;
?>