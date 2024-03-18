<?php
require_once dirname(__FILE__).'/../config.php';



include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kredyt,&$okr_kr,&$operation){
	$kredyt = isset($_REQUEST['kredyt']) ? $_REQUEST['kredyt'] : null;
	$okr_kr = isset($_REQUEST['okr_kr']) ? $_REQUEST['okr_kr'] : null;
	$opr = isset($_REQUEST['opr']) ? $_REQUEST['opr'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kredyt,&$okr_kr,&$opr,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($kredyt) && isset($okr_kr) && isset($opr))) {
		
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $kredyt == "") {
		$messages [] = 'Nie podano liczby 1';
	}
	if ( $okr_kr == "") {
		$messages [] = 'Nie podano liczby 2';
	}
	if ( $opr == "") {
		$messages [] = 'Nie podano liczby 3';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $kredyt )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $okr_kr )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	
	if (! is_numeric( $opr )) {
		$messages [] = 'Trzecia wartość nie jest liczbą całkowitą';
	}	

	if (count ( $messages ) != 0) return false;
	else return true;
	

    return true;
}

function process(&$kredyt, &$okr_kr, &$opr, &$messages, &$miesiecznaRata) {
    global $role;

    // konwersja parametrów na float
    $kredyt = floatval($kredyt);
    $okr_kr = intval($okr_kr);
    $opr = floatval($opr);

    // sprawdzenie, czy suma kredytu przekracza limit dla użytkownika
    if($kredyt > 150000 && $role <> 'admin'){
        $messages [] = "Tylko administrator może otrzymać kredytpowyżej 150 000 zł";
    }else{
        $x = $opr / 100; // oprocentowanie w procentach
        $y = $okr_kr * 12; // okres kredytowania w miesiącach

         // obliczenie raty miesięcznej
        $miesiecznaRata = ($kredyt * $x) / $y;
    }
}


//definicja zmiennych kontrolera
$kredyt = null;
$okr_kr = null;
$opr = null;
$miesiecznaRata = null
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kredyt,$okr_kr,$opr);
if ( validate($x,$okr_kr,$opr,$messages) ) { // gdy brak błędów
	process($x,$okr_kr,$opr,$messages,$miesiecznaRata);
}


include 'calc_view.php';
