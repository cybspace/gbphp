<?php
	include_once 'dependencies.php';

	$header = 'Калькулятор (select)';
	$task = 'Создать форму-калькулятор с операциями: сложение, вычитание, умножение, деление. Не забыть обработать деление на ноль! Выбор операции можно осуществлять с помощью тега select.';
	include $TEMPLATES_DIR . 'task_template.php';
	include $TEMPLATES_DIR . 'calc_select_view.php';
			
			$result = 0;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$arg1 = $_POST['first_num'];
				$arg2 = $_POST['second_num'];
				$operation = $_POST['operation'];

				$result = do_some_math($arg1, $arg2, $operation);
			};
?>
