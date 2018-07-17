<?php
	include "menu.php";
	
	$header = 'Задание 1';
	$task = 'Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:<br><br>
если $a и $b положительные, вывести их разность;<br>
если $а и $b отрицательные, вывести их произведение;<br>
если $а и $b разных знаков, вывести их сумму;<br><br>
Ноль можно считать положительным числом.';
?>

<html>
	<head>
		
	</head>
	<body>
		<h1><?php echo $header?></h1>
		<p><?php echo $task?></p>
		<h1>Результат</h1>
		<p>
			<?php
				$a = 0;
                $b = -5;
            
                function math ($a, $b) {
					if($a < 0 xor $b < 0) {
                        return $a + $b;
                    } else if ($a < 0) {
                        return $a * $b;
                    } else {
                        return $a - $b;
                    };
                };
                
            
                echo math($a, $b);
			?>
		</p>
		
	</body>
</html>