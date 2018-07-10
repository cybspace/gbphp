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
				function formatMinutes ($min) {
                    $output = 'минут';
    
                    if ($min % 10 === 1 && $min !== 11) {
                        $output .= 'a';
                    } else if ($min % 10 > 1 && $min % 10 < 5) {
                        if ($min < 12 || $min > 14) {
                            $output .= 'ы';
                        };
                    };
                    
                    return $output;
                };
            
                 function formatHours ($min) {
                    $output = 'часов';
    
                    if ($min % 10 === 1 && $min !== 11) {
                        $output = 'час';
                    } else if ($min % 10 > 1 && $min % 10 < 5) {
                        if ($min < 12 || $min > 14) {
                            $output = 'часа';
                        };
                    };
                    
                    return $output;
                };
            
                $currentTime = [
                    'h' => (int)date("s"),
                    'm' => (int)date("s")
                               ];
                
                echo $currentTime['h'] . ' ' . formatHours($currentTime['h']) . ' ' . $currentTime['m'] . ' ' . formatMinutes($currentTime['m']);
                    
			?>
		</p>
		
	</body>
</html>