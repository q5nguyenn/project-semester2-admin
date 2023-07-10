<?php

// POST
function getPOST($field)
{
	$resul = '';
	if (isset($_POST[$field])) {
		$resul = $_POST[$field];
	}
	return $resul;
}

// GEST
function getGET($field)
{
	$resul = '';
	if (isset($_GET[$field])) {
		$resul = $_GET[$field];
	}
	return $resul;
}

//get Percent 
function percent($a, $b)
{
	return round(($b - $a) / $b, 2) * 100;
}



function asset($path)
{
	return BASE_URL . $path;
}

function showStarRate($rate)
{
	$rate = floatval($rate);
	$num =  round($rate * 2) / 2.0;
	$phannguyen = floor($num);
	$phandu = $num - $phannguyen;
	$htmlString = "";
	if ($phandu == 0) {
		for ($i = 1; $i <= $phannguyen; $i++) {
			$htmlString .= '<i class="bi bi-star-fill"></i>';
		}
		for ($i = $phannguyen + 1; $i <= 5; $i++) {
			$htmlString .= '<i class="bi bi-star"></i>';
		}
	} else {
		for ($i = 1; $i <= $phannguyen; $i++) {
			$htmlString .= '<i class="bi bi-star-fill"></i>';
		}
		$htmlString .= '<i class="bi bi-star-half"></i>';
		for ($i = $phannguyen + 2; $i <= 5; $i++) {
			$htmlString .= '<i class="bi bi-star"></i>';
		}
	}
	return $htmlString;
}

function setInterval($f, $seconds)
{
	while (true) {
		$f();
		sleep($seconds);
	}
}
