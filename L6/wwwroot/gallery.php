<?php
	include_once 'dependencies.php';
	
	$header = 'Просмотр галереи';
	$task = 'Просмотр всех фотографий (уменьшенных копий)';

?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>

		<?php
			$message = get_image_init_message();
			$gallery = do_load_images();

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$message = do_save_image('image');
				$gallery = do_load_images();
				
			};
		?>

		<div>
			<?php 
			
				include $TEMPLATES_DIR . 'upload_form.php';
				include $TEMPLATES_DIR . 'gallery.php';
			?>
		</div>		 
		
	</body>
</html>