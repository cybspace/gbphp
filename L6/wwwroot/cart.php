<?php
    include_once 'dependencies.php';
    $id = $_GET['id'];
    $product = select_single_product_by_attr('p.id', $id);
    include $TEMPLATES_DIR . 'product_single_view.php';
?>
