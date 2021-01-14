<?
header("Content-type: application/json; charset=utf-8"); //говорим страниц, что будет возвращен JSON	

 if (isset($_POST['arr_type'],$_POST['value'])){//обычная проверка переменных
 $arr_type = $_POST['arr_type'];
 $value = $_POST['value'];
 
 if(is_numeric($value)){//если  ввели число
	 
 $array = array();
 $str = "";
 $result = null;
 
 for ($i=0; $i<10; $i++)//массив состоит из 10 элементов
		{
			$array[$i] = rand(0,10);
		}
		
 if($arr_type == "произвольный"){//если выбрана текущая опция, то сортириовку не производим..
 
 $dx = abs($array[0] - $value);//сравниваем модуль разности входного числа и элем-ов массива
 for ($i=0; $i<10; $i++)
		{
			$str = $str.$array[$i]." ";//для вывода исходного массива, не столь важно...
		}
 }else{
		sort($array);//..иначе производим сортировку без учета индекса, ключа
		$dx = abs($array[0] - $value);
		
		for ($i=0; $i<10; $i++)
		{
			$str = $str.$array[$i]." ";
		}
 }

 for ($i=0; $i<10;$i++){
	 if(abs($array[$i] - $value)<=$dx){//если модуль разности текущего элем-а меньше модуля
				$dx = abs($array[$i] - $value);//разности предыдущего, то модуль  разности обновляем и 
				$result = $i;//в кач-ве ближайшего берем текущий элемент
	 }
 }	 
 		
 echo json_encode( array('err'=>0,'arr'=>$str, 'result'=>$result) );//все нормально, кодируем в JSON и отправляем
 }else{
	echo json_encode( array('err'=>"Ошибка ввода данных! Попробуйте снова!") ); //если не введено числовое значение, отправляем ошибку
 }
 }
?>