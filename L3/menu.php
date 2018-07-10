<?php
	$links = [
		'index' => '<a href="index.php">Главная</a>',
		'task-1' => '<a href="task_1.php">Задание 1</a>',
		'task-2' => '<a href="task_2.php">Задание 2</a>',
		'task-3' => '<a href="task_3.php">Задание 3</a>',
		'task-4' => '<a href="task_4.php">Задание 4</a>',
		'task-5' => '<a href="task_5.php">Задание 5</a>',
		'task-6' => '<a href="task_6.php">Задание 6</a>',		
		'task-7' => '<a href="task_7.php">Задание 7</a>',		
		'task-8' => '<a href="task_8.php">Задание 8</a>',		
		'task-9' => '<a href="task_9.php">Задание 9</a>'		
	];
	
	function makeList($arr) {
		$list = '<ul>';
		foreach ($arr as $key => $value) {
			$list .= '<li>' . $value . '</li>';

		};
		$list .= '</ul>';
		
		return $list;
	}; 

	

	echo makeList($links);

?>