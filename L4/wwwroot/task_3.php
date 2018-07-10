<?php
	include "menu.php";
	include_once __DIR__ . '/../config/main.php';
	include_once $PRIVATE_DIR . 'render.php';

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
			
				echo makeSmartListFunc(makeDirArr($ROOT_DIR));

			?>
		</p>
		
	</body>
</html>