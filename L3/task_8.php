<?php
	include "menu.php";
	
	$header = 'Задание 8';
	$task = '*Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».';
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
					'Московская область' => ['Зеленоград', 'Клин', 'Москва'],	
					'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
					'Рязанская область' => ['Кораблино', 'Ряжск', 'Скопин']
				];
			
				function printArray ($arr) {
					$output = '';
					
					function printValue ($array, $input) {
						$output = $input;
						foreach ($array as $key => $value) {
							if (is_string($key)) {
								$output .= '<br>' . $key . ': ';
								
								if(is_array($value)) {
									$output .= printInnerValue($value);
								} else {
									$output .= checkValue($value);
									$output .= '<br>';
								};								
							} else {
								$output .= checkValue($value);
							};
						};
						
						return $output;
					};
					
					function printInnerValue ($array) {
						$output = '';
						$output = printValue($array, $output);
						return $output;
					};
					
					function checkValue ($value) {
						$arr = preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
						
						if ($arr[0] == 'К') {
							return 	$value  . ', ';		
						};					
					};
					
					
					$output = printValue($arr, $output);	
					return $output;	
				};
				
				echo printArray($districtArr);
			?>
		</p>
		
	</body>
</html>