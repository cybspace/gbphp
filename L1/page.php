<?php
    include 'menu.php';
    
    $header = 'Главная страница';
    $title = &$header;
    $currYear = date(Y);

?>


<html>
    <head>
        <title><?php echo $title?></title>
    </head>
    <body>
        <h1><?php echo $header?></h1>
        <p><?php echo "Сейчас $currYear год." ?></p>
    </body>
</html>