<?php
	include_once 'dependencies.php';
	
	$header = 'Просмотр фото';
	$task = 'Просмотр конкретной фотографии (изображение оригинального размера) по ее ID в базе данных.';
?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<?php
			$file_props_arr = select_all_file_props_from_db ();
			$image_list = get_image_select_list ($file_props_arr);

			if (isset($_GET['image_selector'])) {
				$image_name = $_GET['image_selector'];
				$image_props_arr = select_single_file_props_by_attr('img_name', $image_name);
				$views = increase_img_view_count_by_attr('img_name', $image_name);
				$image = [
					'image' => render_image_from_file_props($image_props_arr, true),
					'views' => $views
				];
			};

			/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$image_name = $_POST['image_selector'];
				$image_props_arr = select_single_file_props_by_attr('img_name', $image_name);
				$views = increase_img_view_count_by_attr('img_name', $image_name);
				$image = [
					'image' => render_image_from_file_props($image_props_arr, true),
					'views' => $views
				];
				
			};*/

			include $TEMPLATES_DIR . 'photo_view.php';
		?>
		
	</body>
</html>