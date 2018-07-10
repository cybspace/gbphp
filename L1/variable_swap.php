<?php
    include "menu.php";

    $a = 1;
    $b = 5;

    echo "<p>Исходные значения: a = $a и b = $b</p>";

    $a = $a ^ $b;
    $b = $a ^ $b;
    $a = $a ^ $b;
    
    echo "<p>
            После применения операций: <br>
                \$a = \$a ^ \$b;<br>
                \$b = \$a ^ \$b;<br>
                \$a = \$a ^ \$b;<br>
            Получаем: a = $a и b = $b
    
    </p>";

?>