<?php
	include "menu.php";
	
	$header = 'Задание 7';
	$task = '*Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:
for (…){ // здесь пусто}';
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
				$count = 10;
			
				for ($i = 0; $i < $count; print($i++)) {
					//empty
				};
			?>
		</p>
		
	</body>
</html>