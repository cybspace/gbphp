<?php
	include "menu.php";
	include 'common_functions.php';
	
	$header = 'Задание 4';
	$task = 'Объявить массив, индексами которого являются буквы русского языка, а значениями –
			соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’,
			‘ю’ => ‘yu’, ‘я’ => ‘ya’).<br>
			Написать функцию транслитерации строк.
			';

?>

<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<p>
			<?php
							
				echo translate('Привет, мир!', $transcribeArr);
			
			?>
		</p>
		
	</body>
</html>