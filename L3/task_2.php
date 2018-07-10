<?php
	include "menu.php";
	
	$header = 'Задание 2';
	$task = 'С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат
				выглядел так:<br>
				0 – это ноль.<br>
				1 – нечётное число.<br>
				2 – чётное число.<br>
				3 – нечётное число.<br>
				…<br>
				10 – чётное число.';
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
				do {
					if ($num === 0) {
						echo $num . ' - это ноль. <br>';
					} else if ($num % 2 === 0) {
						echo $num . ' - чётное число. <br>';
					} else {
						echo $num . ' - нечётное число. <br>';
					};
					
					$num++;
				} while ($num <= 10);
			?>
		</p>
		
	</body>
</html>