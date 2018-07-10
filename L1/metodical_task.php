<?php
    include "menu.php";

    echo "<p>Hello world</p>";
    $name = "Dima";
    echo "<p>Hello, $name</p>";

    define('MY_CONST', 100); 
    echo MY_CONST . "<br>";

    $int10 = 42;
    $int2 = 0b101010;
    $int8 = 052;
    $int16 = 0x2A;
    echo "Десятеричная система $int10 <br>";
    echo "Двоичная система $int2 <br>";
    echo "Восьмеричная система $int8 <br>";
    echo "Шестнадцатеричная система $int16 <br>";  
    
    $a = 4;
    $b = 5;
    var_dump($a == $b); echo "<br>";
    var_dump($a < $b); echo "<br>";
    var_dump($a <> $b); echo "<br>";
    var_dump($a != $b); echo "<br>";
    var_dump($a !== $b); echo "<br>";
    var_dump($a <= $b); echo "<br>";
    var_dump($a >= $b); echo "<br>";
?>
