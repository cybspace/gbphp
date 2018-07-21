<?php
	include_once 'dependencies.php';
	
	$header = 'Калькулятор (кнопочный)';
	$task = 'Создать калькулятор, который будет определять тип выбранной пользователем операции, ориентируясь на нажатую кнопку.';

	include $TEMPLATES_DIR . 'task_template.php';
	include $TEMPLATES_DIR . 'calc_buttons_view.php';

			$result = 0;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$arg1 = $_POST['first_num'];
				$arg2 = $_POST['second_num'];
				$operation = $_POST['operation'];

				$result = do_some_math($arg1, $arg2, $operation);
			};
?>