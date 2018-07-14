<?php
	include_once 'dependencies.php';

	$header = 'Задание 3';
	$task = 'Написать функцию, отображающую все дерево файлов и каталогов, начиная от указанной директории.';
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
			
				echo make_smart_list_func(get_dir_content($ROOT_DIR));

			?>
		</p>
		
	</body>
</html>