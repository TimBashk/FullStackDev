<?
include_once 'Classes/pdo_connect_db.php';

function load_base_table(){
	$connect = new pdo_connect_db("localhost","root","root","web_dev_db");
	$connect->connect_pdo();
	
	$query = $connect->PDO->prepare("SELECT * FROM `users`");//сначала отображаем все записи таблицы
	$query->execute();

	while($row = $query->fetch()){
		    $gender = '';
			if ($row['gender'] == 1){//вместо нумерации полов
				$gender = 'мужской';//выводим обычные муж.,
			}else
			{
				$gender = 'женский';//и жен.,
			} 
			echo "<td>".$row['id']."</td>";//все
			echo "<td>".$row['name']."</td>";//записываем
			echo "<td>".$gender."</td>";//в таблицу
			echo "<td>".$row['dep_id']."</td> </tr>";
	    }
	$connect->close_connect_pdo();
	unset($connect);
}       
function load_count_gender_table(){
	$connect = new pdo_connect_db("localhost","root","root","web_dev_db");
	$connect->connect_pdo();
	
	$query = $connect->PDO->prepare("SELECT dep_id,
                                     SUM( CASE WHEN `gender`=2 THEN 1 ELSE 0 END) AS w_count,
									 SUM( CASE WHEN `gender`=1 THEN 1 ELSE 0 END) AS m_count
									 FROM `users` GROUP BY dep_id");//считываем кол-во женщин и мужчин
									 //по департаментам
	$query->execute();

	while($row = $query->fetch()){
		
			echo "<td>".$row['dep_id']."</td>";//выводим...
			echo "<td>".$row['w_count']."</td>";
			echo "<td>".$row['m_count']."</td> </tr>";
			
	    }
	$connect->close_connect_pdo();
	unset($connect);
} 	
?>