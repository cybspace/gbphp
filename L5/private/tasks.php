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


function get_dir_content ($dir, $only_files = false) {
    $out_arr = [];
    $useless_path = ['.', '..'];
  
    foreach (scandir($dir) as $k => $v) {
      if (!in_array($v, $useless_path)) {
        if (is_dir($dir.$v.'/') && !$only_files) {
          $out_arr[$v] = get_dir_content($dir.$v.'/');
        } else if (!is_dir($dir.$v.'/')) {
          array_push($out_arr, $v);
        };
      };
    };
    return $out_arr;
  };

function do_save_image ($form_name) {
    global $IMG_THUMBNAILS_WIDTH;
    global $WWWROOT_DIR;

    $file = $_FILES[$form_name];
    $message = null;

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

            $file_props = make_file_props_arr($file_name, $img_original_path, $img_thumbnail_path);
            $is_uploaded = move_uploaded_file($file_tmp_name, $src);
            $is_resized = img_resize($src, $dest, $IMG_THUMBNAILS_WIDTH, $IMG_THUMBNAILS_WIDTH);
            $is_saved = insert_file_props_into_db($file_props);

            $message =  $is_uploaded && $is_resized && $is_saved ? 'Загрузка прошла успешно!' : 'Загрузка не удалась!';
        } else {
            $message = "Загрузка не удалась: недопустимый формат или размер!<br>" . $warning_message;
        };

    };

    return $message;
};
