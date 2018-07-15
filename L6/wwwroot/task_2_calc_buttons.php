<?php
	include_once 'dependencies.php';
	
	$header = 'Задание 2';
	$task = 'Создать калькулятор, который будет определять тип выбранной пользователем операции, ориентируясь на нажатую кнопку.';
?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<?php
			include $TEMPLATES_DIR . 'calc_buttons_view.php';

			$result = 0;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$arg1 = $_POST['first_num'];
				$arg2 = $_POST['second_num'];
				$operation = $_POST['operation'];

				$result = do_some_math($arg1, $arg2, $operation);
			};
			
		?>
		<h3>Результат: <?=$result?></h3>
		
	</body>
</html>