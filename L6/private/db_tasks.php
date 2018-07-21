<?php
  include_once __DIR__ . '/../config/main.php';
  include_once 'dependencies.php';

/*******************************************
file_props_arr = [
    'id' => null
    'file_name' => $file_name,
    'url' => $file_url,
    'thumbnail_url' => $file_thumbnail_url,
    'alt_url' => $file_alt_url
];
********************************************/

function manage_connection ($close = false) {
    include_once __DIR__ . '/../config/main.php'; 
    static $CURRENT_CONNECTION;
    static $CONNECTION_PARAMS = [
        'host' => '127.0.0.1',
        'user' => 'root',
        'passw' => '1q2we34r',
        'db' => 'gbphp_db'
    ];
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

function check_if_row_exists_by_attr ($attr_value, $table, $attr) {
    $conn = manage_connection();
    $select = "SELECT * FROM {$table} WHERE {$attr} = '{$attr_value}';";
    $result = mysqli_query($conn, $select);
    $result_arr = mysqli_fetch_all($result);

    return (count($result_arr) > 0);
};

function save_file_props_in_db ($file_props_arr) {
    if (!is_array($file_props_arr) && !isset($file_props_arr)) return false;

    $conn = manage_connection();
    $is_exist = check_if_row_exists_by_attr($file_props_arr['url'], 't_site_resources', 'url');
    if (!$is_exist) {
        $insert = "INSERT INTO t_site_resources (url, thumbnail_url) 
                   VALUES ('{$file_props_arr['url']}', '{$file_props_arr['thumbnail_url']}');";
    } else {
        return false;
    };
    
    $result = mysqli_query($conn, $insert);
    $id_resource = mysqli_insert_id($conn);
    
    if ($id_resource !== 0) {
        $insert = "INSERT INTO t_site_images (id_resource, img_name) 
                    VALUES ({$id_resource}, '{$file_props_arr['file_name']}');";
        $result = mysqli_query($conn, $insert);
        $id_resource = mysqli_insert_id($conn);
    };

    return $id_resource !== 0 ? true : false;

};

function select_all_file_props_from_db () {
    $conn = manage_connection();
    $file_props_arr = null;
    $select = "SELECT img.id, img_name as file_name, url, thumbnail_url, img_views as views
                FROM gbphp_db.t_site_images img
                JOIN gbphp_db.t_site_resources url ON img.id_resource = url.id
                ORDER BY img_views DESC;";
    
    $result = mysqli_query($conn, $select);
    $file_props_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $file_props_arr;
};

function select_single_file_props_by_attr ($attr_name, $attr_value) {
    $conn = manage_connection();
    $file_props_arr = null;
    $select = "SELECT img.id, img_name as file_name, url, thumbnail_url, img_views as views
                FROM gbphp_db.t_site_images img
                JOIN gbphp_db.t_site_resources url ON img.id_resource = url.id
                WHERE {$attr_name} = '{$attr_value}';";
    $result = mysqli_query($conn, $select);
    $file_props_arr = mysqli_fetch_assoc($result);

    return $file_props_arr;
};

function increase_img_view_count_by_attr ($attr_name, $attr_value) {
    $conn = manage_connection();
    $file_props_arr = null;
    $select = "SELECT img_views
                FROM gbphp_db.t_site_images img
                WHERE {$attr_name} = '{$attr_value}';";
    
    $result = mysqli_query($conn, $select);
    $row_arr = mysqli_fetch_assoc($result);
    $views = $row_arr['img_views'] + 1;

    $update = "UPDATE gbphp_db.t_site_images 
                SET img_views = {$views}
                WHERE {$attr_name} = '{$attr_value}';";
    $result = mysqli_query($conn, $update);

    return $views;
};

function save_comment_in_db ($comment_attrs) {
    if (!is_array($comment_attrs) && !isset($comment_attrs)) return false;

    $conn= manage_connection();
    $commentee = $comment_attrs['commentee'];
    $comment = $comment_attrs['comment'];
    $id_subject = $comment_attrs['id_subject'];
    $insert = "INSERT INTO t_site_comments (id_subject, commentee, comment)
                VALUES ({$id_subject}, '{$commentee}', '{$comment}');";

    $result = mysqli_query($conn, $insert);
    $id_resource = mysqli_insert_id($conn);

    return $id_resource !== 0 ? true : false;
};

function select_all_comments_from_db_by_id_subj ($id_subject) {
    if (!isset($id_subject)) return null;
    $conn = manage_connection();
    $comments = null;

    $select = "SELECT commentee, comment, dt_ins, id_subject
                FROM gbphp_db.t_site_comments
                WHERE id_subject = {$id_subject};";

    $result = mysqli_query($conn, $select);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $comments;
};

function select_all_products_from_db () {
    $conn = manage_connection();
    $products = null;
    $select = "SELECT 
              	  p.id, 
                  p.product_name as name, 
                  p.product_short_desc as short_desc, 
                  p.product_full_desc as full_desc,
                  p.product_price as price,
                  res.url,
                  res.thumbnail_url
              FROM gbphp_db.t_site_product p
              JOIN gbphp_db.t_product_images pi on pi.id_product = p.id
              JOIN gbphp_db.t_site_images img on img.id = pi.id_image
              JOIN gbphp_db.t_site_resources res on res.id = img.id_resource;";
    
    $result = mysqli_query($conn, $select);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $products;
};

function select_single_product_by_attr ($attr_name, $attr_value) {
    $conn = manage_connection();
    $product = null;
    $select = "SELECT 
                  p.id, 
                  p.product_name as name, 
                  p.product_short_desc as short_desc, 
                  p.product_full_desc as full_desc,
                  p.product_price as price,
                  res.url,
                  res.thumbnail_url
                FROM gbphp_db.t_site_product p
                JOIN gbphp_db.t_product_images pi on pi.id_product = p.id
                JOIN gbphp_db.t_site_images img on img.id = pi.id_image
                JOIN gbphp_db.t_site_resources res on res.id = img.id_resource
                WHERE {$attr_name} = '{$attr_value}';";
    $result = mysqli_query($conn, $select);
    $product = mysqli_fetch_assoc($result);

    return $product;
};