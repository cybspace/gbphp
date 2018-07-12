<?php
	include "menu.php";
	include_once __DIR__ . '/../config/main.php';
	include_once $PRIVATE_DIR . 'render.php';
	
	$header = 'Задание 4';
	$task = 'Написать функцию, удаляющуюю указанную папку(с ее полным очищением)';
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
				
                echo make_smart_list_func(make_dir_arr($ROOT_DIR.'testfolder/'));
                delete_dir($ROOT_DIR.'testfolder/', true);
			?>
		</p>
		
	</body>
</html>