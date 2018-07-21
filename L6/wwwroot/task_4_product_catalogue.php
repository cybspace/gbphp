<?php
    include_once 'dependencies.php';

    $header = 'Каталог товаров';
    $task = 'Создать страницу каталога товаров:
             <ul>
                 <li>товары хранятся в БД (структура прилагается);</li>
                 <li>страница формируется автоматически;</li>
                 <li>по клику на товар открывается карточка товара с подробным описанием;</li>
                 <li>подумать, как лучше всего хранить изображения товаров.</li>
             </ul>';

    $products = select_all_products_from_db();

    include $TEMPLATES_DIR . "task_template.php";
    include $TEMPLATES_DIR . "product_catalogue_view.php";
?>

