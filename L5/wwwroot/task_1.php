<?php
	include 'dependencies.php';
	
	$header = 'Задание 1 и 2';
	$task = ' Создать галерею фотографий. Она должна состоять всего из одной странички, на которой пользователь видит все картинки в уменьшенном виде и форму для загрузки нового изображения. При клике на фотографию она должна открыться в браузере в новой вкладке. Размер картинок можно ограничивать с помощью свойства width. При загрузке изображения необходимо делать проверку на тип и размер файла.<br>*При загрузке изображения на сервер должна создаваться его уменьшенная копия, а на странице index.php должны выводиться именно копии. На реальных сайтах это активно используется для экономии трафика. При клике на уменьшенное изображение в браузере в новой вкладке должен открываться оригинал изображения. Функция изменения размера картинок дана в исходниках. Вам необходимо суметь встроить ее в систему.';

?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<?php
			$max_size = format_num_by_bytes($IMG_MAX_SIZE);
			$file_extension = '';
			for ($i = 0; $i < count($IMG_VALID_EXTENSIONS); $i++) {
				$file_extension .= $IMG_VALID_EXTENSIONS[$i];
				$file_extension .= $i === count($IMG_VALID_EXTENSIONS) - 1 ? '.' : ', ';
			};

			$warning_message = "Разрешенный максимальный рамер файла $max_size байт и форматы: $file_extension";
			$message = "Выберите картинку для загрузки:<br>" . $warning_message;

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (isset($_FILES['image'])) {
					$image = $_FILES['image'];
					if (verify_image($image['name'], $image['size'])) {
						$img_original_path = 'resources/img/' . $image['name'];
						$img_thumbnail_path = 'resources/img/small/' . $image['name'];
						$src = $WWWROOT_DIR . $img_original_path;
						$dest = $WWWROOT_DIR . $img_thumbnail_path;

						$is_uploaded = move_uploaded_file($image['tmp_name'], $src);
						$is_resized = img_resize($src, $dest, $IMG_THUMBNAILS_WIDTH, $IMG_THUMBNAILS_WIDTH);
						
						$message =  $is_uploaded && $is_resized ? 'Загрузка прошла успешно!' : 'Загрузка не удалась!';
						render_image_by_path($img_thumbnail_path, $img_original_path);
					} else {
						$message = "Загрузка не удалась: недопустимы формат или размер!<br>" . $warning_message;
					};

				};
			};
		?>
		<p>
			<?php
				include $TEMPLATES_DIR . 'upload_form.php';
			?>
		</p>

		 <div id="rendered_images">
			<?php
				$img_thumbnails_path = 'resources/img/small/';
				$img_originals_path = 'resources/img/';

				echo render_images_from_folder($img_thumbnails_path, $img_originals_path);
			?>
		 </div>
		
	</body>
</html>