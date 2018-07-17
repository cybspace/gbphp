<?php
	$links = [
		'index' => '<a href="index.php">Текст задания</a>',
		'task-1' => '<a href="task_1_calc_select.php">Калькулятор (select)</a>',
		'task-2' => '<a href="task_2_calc_buttons.php">Калькулятор (кнопочный)</a>',
		'task-3' => '<a href="task_3_photo_view.php">Отзывы</a>'/*,
		'task-4' => '<a href="task_4.php">Задание 4</a>',
		'task-5' => '<a href="task_5.php">Задание 5</a>',
		'task-6' => '<a href="task_6.php">Задание 6</a>'*/		
	];

	foreach ($links as $key => $value) {
		echo $value . '<br>';
		
	};

?>