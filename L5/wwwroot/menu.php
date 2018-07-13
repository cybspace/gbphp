<?php
	$links = [
		'index' => '<a href="index.php">Текст задания</a>',
		'task-1' => '<a href="task_1.php">Просмотр галереи</a>',
		'task-2' => '<a href="task_2.php">Просмотр фото</a>'/*,
		'task-3' => '<a href="task_3.php">Задание 3</a>',
		'task-4' => '<a href="task_4.php">Задание 4</a>',
		'task-5' => '<a href="task_5.php">Задание 5</a>',
		'task-6' => '<a href="task_6.php">Задание 6</a>'*/		
	];

	foreach ($links as $key => $value) {
		echo $value . '<br>';
		
	};

?>