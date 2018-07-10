<?php
	include "menu.php";
	include 'common_functions.php';

	$header = 'Задание 5';
	$task = 'Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.';
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
							
				echo unSpace('привет, мир! 1 1 1 1');
			?>
		</p>
		
	</body>
</html>