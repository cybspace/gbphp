<?php
  include_once __DIR__ . '/../config/main.php';
  include_once 'dependencies.php';

/*******************************************
file_props_arr = [
    'file_name' => $file_name,
    'url' => $file_url,
    'thumbnail_url' => $file_thumbnail_url,
    'alt_url' => $file_alt_url
];
 *******************************************/

function manage_connection ($close = false) {
    global $CURRENT_CONNECTION;
    global $CONNECTION_PARAMS;
    $current_thread = mysqli_thread_id($CURRENT_CONNECTION);

    if (is_null($current_thread) && $close === false) {
            $CURRENT_CONNECTION = mysqli_connect(
                $CONNECTION_PARAMS['host'], 
                $CONNECTION_PARAMS['user'], 
                $CONNECTION_PARAMS['passw'], 
                $CONNECTION_PARAMS['db']
            );
    } else if (!is_null($current_thread) && $close) {
        mysqli_close($CURRENT_CONNECTION);
    };
    
    return $CURRENT_CONNECTION;
};

function check_if_file_exist_by_attr ($attr_value, $table, $attr) {
    $conn = manage_connection();
    $select = "SELECT * FROM {$table} WHERE {$attr} = '{$attr_value}'";
    $result = mysqli_query($conn, $select);
    $result_arr = mysqli_fetch_all($result);

    return (count($result_arr) > 0);
};

function insert_file_props_into_db ($file_props_arr) {
    $conn = manage_connection();
    $is_exist = check_if_file_exist_by_attr($file_props_arr['url'], 't_site_resources', 'url');
    if (!$is_exist) {
        $insert = "INSERT INTO t_site_resources (url, thumbnail_url) 
                   VALUES ('{$file_props_arr['url']}', '{$file_props_arr['thumbnail_url']}')";
    };
    
    $result = mysqli_query($conn, $insert);
    $id_resource = mysqli_insert_id($conn);
    $insert = "INSERT INTO t_site_images (id_resource, img_name) 
               VALUES ({$id_resource}, '{$file_props_arr['file_name']}')";
    $result = mysqli_query($conn, $insert);
    $id_resource = mysqli_insert_id($conn);

    return !is_null($id_resource) ? true : false;

};
