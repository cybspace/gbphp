<?php
  include_once __DIR__ . '/../config/main.php';
  include_once 'dependencies.php';

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

function insert_file_props_into_db ($file_props_arr) {
    $conn = manage_connection();
    $insert = "INSERT INTO t_site_resources (url, thumbnail_url, alt_url) 
               VALUES ({$file_props_arr['url']}, {$file_props_arr['thumbnail_url']}, {$file_props_arr['alt_url']})";
    
    return $insert;

};