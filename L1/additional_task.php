<?php
    include "menu.php";

    $name = 'Дима';
    $age = '30';
    $currDate = date('d-m-y H:i');

    $pageText = "Меня зовут $name.<br>Через год мне будет " . ($age + 1) . " год, а еще через год " . ($age + 2) . " года.<br>На моих часах сейчас $currDate<br>";

    echo $pageText;

    $pageTextUnderscored = str_replace(" ", "_", $pageText);
    echo "<br>" . $pageTextUnderscored;

    $pageTextTime = strstr($pagetext, "На");
    echo "<br>" . $pageTextTime;
?>