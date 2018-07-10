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
			
				function makeSmartListFunc ($arr) {
					$list = '<ul>';
					
					function makeSimpleListFunc ($array, $list) {
						$output = $list;
						foreach ($array as $key => $value) {
							if (is_string($key)) {
								$output .= makeLiElement($key);
								
								if(is_array($value)) {
									$output .= '<ul>';
									$output .= makeInnerListFunc($value);
									$output .= '</ul>';
								} else {
									$output .= '<ul>';
									$output .= makeLiElement($value);
									$output .= '</ul>';
								};								
							} else {
								$output .= makeLiElement($value);
							};
						};
						
						return $output;
					};
					
					function makeInnerListFunc ($array) {
						$output = '';
						$output = makeSimpleListFunc($array, $output);
						return $output;
					};
					
					function makeLiElement ($text) {
						return '<li>' . $text . '</li>';
					};
					
					$list = makeSimpleListFunc($arr, $list);			
					$list .= '</ul>';
					return $list;
				};
			
			echo makeSmartListFunc($districtArr);
				
			?>
		</p>
		
	</body>
</html>