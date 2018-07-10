<?php
	$transcribeArr = [
					'а' => 'a', 'б' => 'b',	'в' => 'v', 'г' => 'g',	'д' => 'd',
					'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',	'и' => 'i',
					'й' => 'j', 'к' => 'k',	'л' => 'l', 'м' => 'm',	'н' => 'n',
					'о' => 'o', 'п' => 'p',	'р' => 'r', 'с' => 's',	'т' => 't',
					'у' => 'u', 'ф' => 'f',	'х' => 'kh', 'ц' => 'ts',	'ч' => 'ch',
					'ш' => 'sh', 'щ' => 'shch',	'ъ' => '\'', 'ы' => 'i',	'ь' => '\'',
					'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
					
				];
			
	function translate ($phrase, $transArr) {
		$phraseArr = preg_split('//u', $phrase, -1, PREG_SPLIT_NO_EMPTY);
		$outputLine = '';
		
		foreach ($phraseArr as $key => $value) {
			$letter = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
			if (array_key_exists($letter, $transArr) == 1) {
				$outputLine .= 	$transArr[$letter];
			} else if ($letter == ' ') {
				$outputLine .= 	$letter;
			};						
		};
		return $outputLine;
	};

	function unSpace ($phrase) {
			return str_replace(' ', '_', $phrase);
		};

	
?>