<?php
	include "menu.php";
	
	$header = 'Задание 7';
	$task = '*Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например: 22 часа 15 минут, 21 час 43 минуты.';
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
				function format_time ($num, $type) {
                    //$type: h - часы
                    //       m - минуты
                    $is_minutes = $type === 'm';
                    $output = $is_minutes ? 'минут' : 'часов';
    
                    if ($min % 10 === 1 && $min !== 11) {
                        $is_minutes ? $output .= 'a' : $output = 'час';
                    } else if ($min % 10 > 1 && $min % 10 < 5) {
                        if ($min < 12 || $min > 14) {
                            $is_minutes ? $output .= 'ы' : $output = 'часа';
                        };
                    };
                    
                    return $output;
                };
            
                $currentTime = [
                    'h' => (int)date("s"),
                    'm' => (int)date("s")
                               ];
                
                echo $currentTime['h'] . ' ' . format_time($currentTime['h'], 'h') . ' ' . $currentTime['m'] . ' ' . format_time($currentTime['m'], 'm');
                    
			?>
		</p>
		
	</body>
</html>