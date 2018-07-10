<?php
  include_once __DIR__ . '/../config/main.php';
  
function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
/***********************************************************************************
 Функция img_resize(): генерация thumbnails
 Параметры:
   $src             - имя исходного файла
   $dest            - имя генерируемого файла
   $width, $height  - ширина и высота генерируемого изображения, в пикселях
 Необязательные параметры:
   $rgb             - цвет фона, по умолчанию - белый
   $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
 ***********************************************************************************/
  if (!file_exists($src)) return false;

  $size = getimagesize($src);

  if ($size === false) return false;

  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;

  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];

  $ratio       = min($x_ratio, $y_ratio);
  $use_x_ratio = ($x_ratio == $ratio);

  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
  $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

  $isrc = $icfunc($src);
  $idest = imagecreatetruecolor($width, $height);

  imagefill($idest, 0, 0, $rgb);
  imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
    $new_width, $new_height, $size[0], $size[1]);

  imagejpeg($idest, $dest, $quality);

  imagedestroy($isrc);
  imagedestroy($idest);

  return true;
};

function getFileExtension ($filename) {
  return substr($filename, strripos($filename, '.') + 1);
};

function verifyImage ($name, $size) {
  global $IMG_MAX_SIZE;
  global $IMG_VALID_EXTENSIONS;

  if ($size > $IMG_MAX_SIZE) {
    return false;
  };
  
  $extension = getFileExtension($name);
  if (!in_array($extension, $IMG_VALID_EXTENSIONS)) {
    return false;
  };

  return true;
};

function makeDirArr ($dir) {
  $out_arr = [];
  $useless_path = ['.', '..'];

  foreach (scandir($dir) as $k => $v) {
    if (!in_array($v, $useless_path)) {
      if (is_dir($dir.$v.'/')) {
        $out_arr[$v] = makeDirArr($dir.$v.'/');
      } else {
        array_push($out_arr, $v);
      };
    };
  };
  
  return $out_arr;
};

function makeSmartListFunc ($arr) {
  $list = '<ul>';
  
  function makeSimpleListFunc ($array, $list) {
    $output = $list;
    foreach ($array as $key => $value) {
      if (is_string($key)) {
        $output .= makeLiElement($key, true);
        
        if(is_array($value)) {
          $output .= '<ul>';
          $output .= makeInnerListFunc($value);
          $output .= '</ul>';
        } else {
          $output .= '<ul>';
          $output .= makeLiElement($value);
          $output .= '</ul>';
        };								
      } else {
        $output .= makeLiElement($value);
      };
    };
    
    return $output;
  };
  
  function makeInnerListFunc ($array) {
    $output = '';
    $output = makeSimpleListFunc($array, $output);
    return $output;
  };
  
  function makeLiElement ($text, $is_bold = false) {
    if ($is_bold) return '<li><strong>' . $text . '</strong></li>';
    return '<li>' . $text . '</li>';
  };
  
  $list = makeSimpleListFunc($arr, $list);			
  $list .= '</ul>';
  return $list;
};

function deleteDir ($dir_path, $view_only = true) {

  function clearDir ($dir_path, $view_only) {
      $useless_path = ['.', '..'];
      $dir = opendir($dir_path);

      while($item = readdir($dir)) {
          if (!in_array($item, $useless_path)) {
              $item_path = $dir_path.$item;

              if (is_dir($item_path)) {
                  $item_path .= '/';
                  clearDir($item_path, $view_only);

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
      clearDir($dir_path, $view_only);
      echo '<br>Будет удалена корневая директория ' . $dir_path . '<br>';
      if (!$view_only) {
          echo rmdir($dir_path) ? 'Корневая директория ' . $dir_path . ' успешно удалена<br>' : 'Директория ' . $dir_path . ' не была удалена<br>';
      }
  };

};

function formatNumByBytes ($num) {
  $bytes_arr = [
    'Tb' => pow(1024, 4),
    'Gb' => pow(1024, 3),
    'Mb' => pow(1024, 2),
    'Kb' => 1024
  ];
  
  foreach ($bytes_arr as $k => $v) {
    if ((int)($num / $v) > 0) {
      return round($num / $v, 2) . ' ' . $k;
    };
  };

};

function render_images_from_folder ($img_thumbnails_path, $img_originals_path) {
  global $WWWROOT_DIR;
  $output = '';
  $img_thumbnails_arr = makeDirArr($WWWROOT_DIR.$img_thumbnails_path);

  foreach ($img_thumbnails_arr as $k => $v) {
    if (!is_array($v)) {
      $output .= render_image_by_path($img_thumbnails_path.$v, $img_originals_path.$v);
    };
  };

  return $output;
};

function render_image_by_path ($img_thumbnail_path, $img_original_path) {
  return '<a href="'.$img_original_path.'" target="_blank"><img src="'.$img_thumbnail_path.'"></a>';
};