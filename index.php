<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="">
    <title>Test site</title>    
    <link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/functions.js"></script>
</head>
<body>
 <?
 include_once('php/db_functions.php');
 ?>
 <h1>Тестовые задания</h1>
</br>
<div class="tasks" id="db_task">
    <h2>База данных</h2>
	<h3>Основная таблица</h3>
	<table id="my-table">
	<thead>
		<tr>
			<th>№</th>
			<th>Фамилия</th>
			<th>Пол</th>
			<th>№ департамента</th>
		</tr>
	</thead>
	
	<tbody>
	 <?
	   load_base_table();
	 ?>
	</tbody>
</table>

<h3>Результат запроса</h3>
	<table id="res-table">
	<thead>
	    <tr>
			<th>№ департамента</th>
			<th>Количество женщин</th>
			<th>Количество мужчин</th>
		</tr>
	</thead>
	
	<tbody>
	 <?
	   load_count_gender_table();
	 ?>
	</tbody>
</table>
</div>

<div class="tasks" id="array_task">
<h2>Функция для работы с массивом чисел</h2>

<span>Введите число:</span>
<input id="input_val" type="text" name="input_txt" value="">
<span>Выберите тип массива:</span>
<select id="arr_type">
	<option value="">произвольный</option>
	<option value="">сорт. по возрастанию</option>
</select>
<button id="btn">OK</button>
</br>
<h3>Сгенерирован случайный массив</h3>
<span id="arr"></span>	
</br>
<h3>Номер элемента массива, наиболее близкий к переданному: </h3>
</br>
<span id="res"></span>
</div>

<script>

$(function() {
	
		
		$("#btn").click(function(){
		var sel = document.getElementById("arr_type"); 
        var val = sel.options[sel.selectedIndex].text;
		
		$.ajax({
		  type: 'POST',
		  url: 'php/array_functions.php',
		  data: {value: $("#input_val").val(),arr_type: val},//отправляемы данные серверу
		  dateType: 'JSON',
		  success: function(data){
			if(data.err == 0){//если ошибку не получили
			$('#arr').html(data.arr);// то заполняем данными
			$('#res').html(data.result);}else
				alert(data.err);//выводим ошибку
		  }
		});
	});
	
});

	

</script>

</body>
</html>