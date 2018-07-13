<?php
  include_once __DIR__ . '/../config/main.php';
  include_once 'dependencies.php';

function do_delete_dir ($dir_path, $view_only = true) {

    function clear_dir ($dir_path, $view_only) {
        $useless_path = ['.', '..'];
        $dir = opendir($dir_path);

        while($item = readdir($dir)) {
            if (!in_array($item, $useless_path)) {
                $item_path = $dir_path.$item;

                if (is_dir($item_path)) {
                    $item_path .= '/';
                    clear_dir($item_path, $view_only);

                    echo '<br>Будет удалена вложенная директория ' . $item_path . '<br>';
                    if (!$view_only) {
                        echo rmdir($item_path) ? 'Вложенная директория ' . $item_path . ' успешно удалена<br>' : 'Вложенная директория ' . $item_path . ' не была удалена<br>';
                    }

                } else {
                    echo '<br>Будет удален файл ' . $item_path . '<br>';
                    if (!$view_only) {
                        echo unlink($item_path) ? 'Файл ' . $item_path . ' успешно удален<br>' : 'Файл ' . $file . ' не был удален<br>';
                    };

                };
            };
        };

        closedir($dir);

    };

    if (is_dir($dir_path)) {
        clear_dir($dir_path, $view_only);
        echo '<br>Будет удалена корневая директория ' . $dir_path . '<br>';
        if (!$view_only) {
            echo rmdir($dir_path) ? 'Корневая директория ' . $dir_path . ' успешно удалена<br>' : 'Директория ' . $dir_path . ' не была удалена<br>';
        }
    };

};

function verify_image ($name, $size) {
  global $IMG_MAX_SIZE;
  global $IMG_VALID_EXTENSIONS;

  if ($size > $IMG_MAX_SIZE) {
    return false;
  };
  
  $extension = get_file_extension($name);
  if (!in_array($extension, $IMG_VALID_EXTENSIONS)) {
    return false;
  };

  return true;
};


function get_file_extension ($file_name) {
    return substr($file_name, strripos($file_name, '.') + 1);
};

function do_load_image ($form_name) {
    global $IMG_THUMBNAILS_WIDTH;
    global $WWWROOT_DIR;
    $file = $_FILES[$form_name];
    $message = '';
    $gallery = false;
    if (isset($file)) {
        $warning_message = get_image_warning_message();
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp_name = $file['tmp_name'];

        if (verify_image($file_name, $file_size)) {
            $img_original_path = 'resources/img/' . $file_name;
            $img_thumbnail_path = 'resources/img/small/' . $file_name;
            $src = $WWWROOT_DIR . $img_original_path;
            $dest = $WWWROOT_DIR . $img_thumbnail_path;
            $is_uploaded = move_uploaded_file($file_tmp_name, $src);
            $is_resized = img_resize($src, $dest, $IMG_THUMBNAILS_WIDTH, $IMG_THUMBNAILS_WIDTH);
            $message =  $is_uploaded && $is_resized ? 'Загрузка прошла успешно!' : 'Загрузка не удалась!';
            $gallery = render_images_from_folder('resources/img/small/', 'resources/img/');
            $image = render_images_by_path($img_thumbnail_path, $img_original_path);
        } else {
            $message = "Загрузка не удалась: недопустимый формат или размер!<br>" . $warning_message;
        };

    };

    return [
        'message' => $message,
        'image' => $image,
        'gallery' => $gallery
    ];
};
