<?php
//==================================
//класс для работы с БД
//==================================

class DBCLass 
{
	private $server,$user,$pass,$dbname;
	private $db = null; // Единственный экземпляр класса, чтобы не создавать множество подключений
	private $mysqli; // Идентификатор соединения

function __construct($server,$user,$pass,$dbname)
    {
		//!echo 'зашли в конструктор'.'</br>';
		$this->server = $server;
		$this->user = $user;
		$this->pass = $pass;
		$this->dbname = $dbname;
		$this->openConnection();                 
    }

//==================================
//Устанавливает соединение с БД
//==================================
public function openConnection()  
{  
	if(!$this->db)  
    {  
		$this->mysqli = mysqli_connect($this->server,$this->user,$this->pass,$this->dbname);  
		
		/* проверка соединения */
		if (mysqli_connect_errno()) {
			printf("Соединение не удалось: %s\n", mysqli_connect_error());
			exit();
		}

		if($this->mysqli)  
        {  
			$this->db = true;//признак, что уже подключены к БД
			return true;
        } else  
        {  
			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
			return false;  
        }  
    } else  
    {  
		return true;  
    }  
}

//==================================
//возвращает запрос, либо false
//Параметры: 
//	$what - строка ( *, либо перечисление полей через запятую)
//	$from - строка (имя таблицы)
//	$order - строка (порядок сортировки)
//	$limit - строка (2 числа через запятую)
//==================================
public function select2($what,$from,$where = null,$order = null,$limit = null)
{
    $sql = 'SELECT '.$what.' FROM '.$from;  
	if($where != null) $sql .= ' WHERE '.$where;  
	if($order != null) $sql .= ' ORDER BY '.$order;  
	if($limit != null) $sql .= ' LIMIT '.$limit;  

	//выполняем запрос
	if ($query = mysqli_query($this->mysqli,$sql))
	{
		return $query;
	}else{
		return false; 
	}
	
	
}

//==================================
// Делает INSERT в таблицу
// $table - строка (название таблицы)
// $values - массив со значениями
// $rows - строка (имена полей - через запятую)
// возвращает: true или false
//==================================
public function insert($table,$values,$rows = null)  
{  
	$insert = 'INSERT INTO '.$table;  
	if($rows != null)  
    {  
        $insert .= ' ('.$rows.')';  
    }  
    
	$numValues = count($values);
	
	for($i = 0; $i < $numValues; $i++)  
    {  
		if(is_string($values[$i])) $values[$i] = '"'.$values[$i].'"';
    }  
    
	//Объединяем элементы массива в строку
	$values = implode(',',$values);  
    $insert .= ' VALUES ('.$values.')';  
	
    $ins = mysqli_query($this->mysqli,$insert);
	
	return ($ins) ? true : false;
}
//==================================
// Удаляет данные из таблицы
// возвращает: true или false
//==================================

public function delete($table,$where = null)
{
	$sql = 'DELETE FROM '.$table.' WHERE '.$where;
	if($where == null)
    {
       $sql = 'DELETE FROM '.$table;
    } 

	$deleted = mysqli_query($this->mysqli,$sql);
	return ($deleted)? true : false;
}
 
//==
/* При уничтожении объекта закрываем соединение с базой данных */
/*public function __destruct() 
{
	if ($this->mysqli) $this->mysqli->close();
}
*/

 
//==
public function closeConnection()
{
	if($this->db)
    {  
		if(mysqli_close($this->mysqli))
        {
            $this->db = false;
			return true;
        }else
        {
			return false;
        }
    }
} 
 
}

?>