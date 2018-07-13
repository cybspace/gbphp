<?php
	include_once 'dependencies.php';
	
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
			$message = get_image_init_message();
            $gallery = render_images_from_folder('resources/img/small/', 'resources/img/');

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$load_inst = do_load_image('image');
				$message = $load_inst['message'];
				$gallery = $load_inst['gallery'];
				var_dump($gallery);
			};

			include $TEMPLATES_DIR . 'upload_form.php';
			include $TEMPLATES_DIR . 'gallery.php';
		?>

		 
		
	</body>
</html>