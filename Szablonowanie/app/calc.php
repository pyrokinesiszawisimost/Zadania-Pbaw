<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/smarty/libs/Smarty.class.php';

//pobranie parametrów
function getParams(&$form){
	$form['kredyt'] = isset($_REQUEST['kredyt']) ? $_REQUEST['kredyt'] : null;
	$form['okr_kr'] = isset($_REQUEST['okr_kr']) ? $_REQUEST['okr_kr'] : null;
	$form['opr'] = isset($_REQUEST['opr']) ? $_REQUEST['opr'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['kredyt']) && isset($form['okr_kr']) && isset($form['opr']) ))	return false;
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['kredyt'] == "") $msgs [] = 'Nie podano liczby 1';
	if ( $form['okr_kr'] == "") $msgs [] = 'Nie podano liczby 2';
        if ( $form['opr'] == "") $msgs [] = 'Nie podano liczby 3';
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $form['kredyt'] )) $msgs [] = 'Pierwsza wartość nie jest liczbą';
		if (! is_numeric( $form['okr_kr'] )) $msgs [] = 'Druga wartość nie jest liczbą';
                if (! is_numeric( $form['opr'] )) $msgs [] = 'Trzecia wartość nie jest liczbą';
	}
	
	if (count($msgs)>0) return false;
	else return true;
}
	
// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na int
	$form['kredyt'] = floatval($form['kredyt']);
	$form['okr_kr'] = floatval($form['okr_kr']);
        $form['opr'] = floatval($form['opr']);
	
	//wykonanie operacji
        
        if (empty ( $msgs )) { 
	
            $x = $form['opr'] / 100;
	    $y = $form['okr_kr'] * 12;
	
            $result = ($form['kredyt'] * $x) / $y;
        }
}

//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$result = null;
$hide_intro = false;
	
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

$smarty->assign('hide_intro',$hide_intro);

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');
