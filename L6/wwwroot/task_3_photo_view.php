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
			$comments_message = ''; //сообщения для формы ввода отзывов
			$comments_arr = null;
			$image_props_arr = null;
			$image = null;

			if (isset($_GET['image_selector'])) {
				$image_name = $_GET['image_selector'];
				$image_props_arr = select_single_file_props_by_attr('img_name', $image_name);
				$comments_arr = select_all_comments_from_db_by_id_subj($image_props_arr['id']);
				var_dump($comments_arr);
				$views = $_SERVER['REQUEST_METHOD'] !== 'POST' ? increase_img_view_count_by_attr('img_name', $image_name) : $image_props_arr['views'];
				$image = [
					'image' => render_image_from_file_props($image_props_arr, true),
					'views' => $views
				];
			};

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$comments_message = '';
				$commentee = $_POST['name'];
				$comment = $_POST['comment'];

				if (is_null($image_props_arr)) {
					$comments_message = 'Сначала выберите изображение';
				} else if (!isset($commentee) || !isset($comment)) {
					$comments_message = !isset($comment) ? "Не указан комментарий!" : "Не указано имя!";
				} else {
					$id_subject = $image_props_arr['id'];
					$comment_attrs = [
						'id_subject' => $id_subject,
						'commentee' => $commentee,
						'comment' => $comment
					];
					$comment_is_saved = save_comment_in_db($comment_attrs);
					$comments_message = $comment_is_saved ? 'Ваш комментарий добавлен!' : 'Ошибка добавления комментария!';
					$comments_arr = select_all_comments_from_db_by_id_subj($id_subject);
				};

				var_dump($comments_arr);

			};

			

			include $TEMPLATES_DIR . 'photo_view.php';
			include $TEMPLATES_DIR . 'comment_form.php';
		?>
		
	</body>
</html>