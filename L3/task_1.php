<?php
	include "menu.php";
	
	$header = 'Задание 1';
	$task = 'С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без
остатка.';
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
				$num = 0;
				while ($num <= 100) {
					if ($num % 3 === 0) {
						echo $num . '<br>';	
					};
					
					$num++;
				};
			?>
		</p>
	</body>
</html>