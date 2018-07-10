<?php
	include "menu.php";
	include 'common_functions.php';
	
	$header = 'Задание 9';
	$task = '*Объединить две ранее написанные функции в одну, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).';
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
				
				echo unSpace(translate('привет, мир!', $transcribeArr));
			?>
		</p>
		
	</body>
</html>