<?php
	include "menu.php";
	
	$header = 'Задание 6';
	$task = 'В имеющемся шаблоне сайта заменить статичное меню (ul – li) на генерируемое через PHP. Необходимо представить пункты меню как элементы массива и вывести их циклом. Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.';
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
					'Московская область' => ['Зеленоград', 'Клин', 'Москва' => ['САО' => ['Куркино', 'Коровино'], 'СВАО' => 'Дегунино', 'ЮАО']],	
					'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
					'Рязанская область' => ['Кораблино', 'Ряжск', 'Скопин']
				];
			
				function make_smart_list_func ($arr) {
					$list = '<ul>';
					
					function make_simple_list_func ($array, $list) {
						$output = $list;
						foreach ($array as $key => $value) {
							if (is_string($key)) {
								$output .= make_li_element($key);
								
								if(is_array($value)) {
									$output .= '<ul>';
									$output .= make_inner_list_func($value);
									$output .= '</ul>';
								} else {
									$output .= '<ul>';
									$output .= make_li_element($value);
									$output .= '</ul>';
								};								
							} else {
								$output .= make_li_element($value);
							};
						};
						
						return $output;
					};
					
					function make_inner_list_func ($array) {
						$output = '';
						$output = make_simple_list_func($array, $output);
						return $output;
					};
					
					function make_li_element ($text) {
						return '<li>' . $text . '</li>';
					};
					
					$list = make_simple_list_func($arr, $list);			
					$list .= '</ul>';
					return $list;
				};
			
			echo make_smart_list_func($districtArr);
				
			?>
		</p>
		
	</body>
</html>