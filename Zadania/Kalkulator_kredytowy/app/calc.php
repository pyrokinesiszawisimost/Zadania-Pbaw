<?php

require_once dirname(__FILE__).'/../config.php';


// 1. pobranie parametrów

$kredyt = $_REQUEST ['kredyt'];
$okr_kr = $_REQUEST ['okr_kr'];
$opr = $_REQUEST ['opr'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($kredyt) && isset($okr_kr) && isset($opr))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $kredyt == "") {
	$messages [] = 'Nie podano kwoty kredytu';
}
if ( $okr_kr == "") {
	$messages [] = 'Nie podano okresu kredytowania(w latach)';
}
if ( $opr == "") {
	$messages [] = 'Nie podano oprocentowania kredytu';
}

if (empty( $messages )) {
	
	// sprawdzenie, czy podane parametry są liczbami całkowitymi
	if (! is_numeric( $kredyt )) {
		$messages [] = 'Podana wartość nie jest liczbą całkowitą';
	}
	if (! is_numeric( $okr_kr )) {
		$messages [] = 'Podana wartość nie jest liczbą całkowitą';
	}	
	if (! is_numeric( $opr )) {
		$messages [] = 'Podana wartość nie jest liczbą całkowitą';
	}

}

// 3. Wykonamy jeżeli wsszytko w porządkuu

if (empty ( $messages )) { 
	
	$x = $opr / 100;
	$y = $okr_kr * 12;
	
	$miesiecznaRata = ($kredyt * $x) / $y;
	
}

// 4. Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
