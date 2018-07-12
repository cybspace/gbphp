<?php

function make_dir_arr ($dir) {
  $out_arr = [];
  $useless_path = ['.', '..'];

  foreach (scandir($dir) as $k => $v) {
    if (!in_array($v, $useless_path)) {
      if (is_dir($dir.$v.'/')) {
        $out_arr[$v] = make_dir_arr($dir.$v.'/');
      } else {
        array_push($out_arr, $v);
      };
    };
  };
  
  return $out_arr;
};

function make_smart_list_func ($arr) {
  $list = '<ul>';
  
  function make_simple_list_func ($array, $list) {
    $output = $list;
    foreach ($array as $key => $value) {
      if (is_string($key)) {
        $output .= make_li_element($key, true);
        
        if(is_array($value)) {
          $output .= '<ul>';
          $output .= make_inner_list_func($value);
          $output .= '</ul>';
        } else {
          $output .= '<ul>';
          $output .= make_li_element($value);
          $output .= '</ul>';
        };								
      } else {
        $output .= make_li_element($value);
      };
    };
    
    return $output;
  };
  
  function make_inner_list_func ($array) {
    $output = '';
    $output = make_simple_list_func($array, $output);
    return $output;
  };
  
  function make_li_element ($text, $is_bold = false) {
    if ($is_bold) return '<li><strong>' . $text . '</strong></li>';
    return '<li>' . $text . '</li>';
  };
  
  $list = make_simple_list_func($arr, $list);			
  $list .= '</ul>';
  return $list;
};

function format_num_by_bytes ($num) {
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