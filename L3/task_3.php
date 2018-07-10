<?php
	include "menu.php";
	
	$header = 'Задание 3';
	$task = 'Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в
			качестве значений – массивы с названиями городов из соответствующей области.<br>
			Вывести в цикле значения массива, чтобы результат был таким:<br><br>
			Московская область:
			Москва, Зеленоград, Клин.<br>
			Ленинградская область:
			Санкт-Петербург, Всеволожск, Павловск, Кронштадт.<br>
			Рязанская область…(названия городов можно найти на maps.yandex.ru)';
?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<p>
			<?php
				$districtArr = [
					'Московская область' => ['Москва', 'Зеленоград', 'Клин'],	
					'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
					'Рязанская область' => ['Кораблино', 'Ряжск', 'Скопин']
				];
			
				function arrEcho ($arr) {
					foreach ($arr as $key => $value) {
						$outputLine = $key . ': ';
						foreach ($value as $index => $city) {
							if ($index !== count($value) - 1) {
								$outputLine .= $city . ', ';
							} else {
								$outputLine .= $city . '. <br>';
							};
						};
						
						echo $outputLine;
					};		
				};
				
				arrEcho($districtArr);
			?>
		</p>
		
	</body>
</html>