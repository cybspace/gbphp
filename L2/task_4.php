<?php
	include "menu.php";
	include "common_functions.php";
	
	$header = 'Задание 4';
	$task = 'Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation),<br>
где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В
зависимости от переданного значения операции выполнить одну из арифметических операций
(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).';
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
				function mathOperation($arg1, $arg2, $operation) {
                    switch ($operation) {
                        case '+': return add($arg1, $arg2); break;
                        case '-': return substract($arg1, $arg2); break;
                        case '*': return multiply($arg1, $arg2); break;
                        case '/': return divide($arg1, $arg2); break;
                        default: return 'Unknown operation: ' . $operation; break;
                    };
                };
            
                $a = 6;
                $b = 9;
                
                echo 'numbers: ' . $a . ' and ' . $b . '<br>';
                echo '+: ' . mathOperation($a, $b, '+') . '<br>';
                echo '-: ' . mathOperation($a, $b, '-') . '<br>';
                echo '*: ' . mathOperation($a, $b, '*') . '<br>';
                echo '/: ' . mathOperation($a, $b, '/') . '<br>';
                echo '%: ' . mathOperation($a, $b, '%') . '<br>';
			?>
		</p>
		
	</body>
</html>