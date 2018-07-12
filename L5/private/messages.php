<?php
  include_once __DIR__ . '/../config/main.php';
  include_once 'dependencies.php';

function get_image_warning_message () {
    global $IMG_MAX_SIZE;
    global $IMG_VALID_EXTENSIONS;

    $max_size = format_num_by_bytes($IMG_MAX_SIZE);
    $file_extension = '';

    for ($i = 0; $i < count($IMG_VALID_EXTENSIONS); $i++) {
        $file_extension .= $IMG_VALID_EXTENSIONS[$i];
        $file_extension .= $i === count($IMG_VALID_EXTENSIONS) - 1 ? '.' : ', ';
    };

    $message = "Разрешенный максимальный рамер файла $max_size байт и форматы: $file_extension";
    return $message;
};

function get_image_init_message () {
    $message = "Выберите картинку для загрузки:<br>" . get_image_warning_message();
    return $message;
};