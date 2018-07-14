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
			$gallery = render_images_from_folder('resources/img/small/', 'resources/img/');
			$img_array = get_dir_content($IMAGES_DIR, true);

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$load_inst = do_save_image('image');
				$message = $load_inst['message'];
				$gallery = $load_inst['gallery'];
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