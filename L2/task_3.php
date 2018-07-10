<?php
	include "menu.php";
	include "common_functions.php";
	
	$header = 'Задание 3';
	$task = 'Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.<br>
Обязательно использовать оператор return.';
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
				            
                $x = 5;
                $y = 6;
                echo 'numbers: ' . $x . ' and ' . $y . '<br>';
                echo 'add: ' . add($x, $y) . '<br>';
                echo 'substract: ' . substract($x, $y) . '<br>';
                echo 'multiply: ' . multiply($x, $y) . '<br>';
                echo 'divide: ' . divide($x, $y) . '<br>';
			?>
		</p>
		
	</body>
</html>