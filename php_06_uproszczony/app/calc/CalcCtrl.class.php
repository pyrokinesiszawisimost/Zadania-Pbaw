<?php
// W skrypcie definicji kontrolera nie trzeba dołączać problematycznego skryptu config.php,
// ponieważ będzie on użyty w miejscach, gdzie config.php zostanie już wywołany.

require_once $conf->root_path.'/lib/libs/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';

/** Kontroler kalkulatora
 * @author Przemysław Kudłacik
 *
 */
class CalcCtrl {

	private $msgs;   
	private $form;  
	private $result; 

	/** 
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
                $this->hide_intro = false;
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->kredyt = isset($_REQUEST ['kredyt']) ? $_REQUEST ['kredyt'] : null;
		$this->form->okr_kr = isset($_REQUEST ['okr_kr']) ? $_REQUEST ['okr_kr'] : null;
		$this->form->opr = isset($_REQUEST ['opr']) ? $_REQUEST ['opr'] : null;
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->kredyt ) && isset ( $this->form->okr_kr ) && isset ( $this->form->opr ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false; //zakończ walidację z błędem
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->kredyt == "") {
			$this->msgs->addError('Nie podano wartości kredytu');
		}
		if ($this->form->okr_kr == "") {
			$this->msgs->addError('Nie podano okresu kredytu');
		}
                if ($this->form->opr == "") {
			$this->msgs->addError('Nie podano oprocentowania');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! $this->msgs->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->kredyt )) {
				$this->msgs->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->okr_kr )) {
				$this->msgs->addError('Druga wartość nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->opr )) {
				$this->msgs->addError('Trzecia wartość nie jest liczbą całkowitą');
			}
		}
		
		return ! $this->msgs->isError();
	}
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this->form->kredyt = intval($this->form->kredyt);
			$this->form->okr_kr = intval($this->form->okr_kr);
                        $this->form->opr = intval($this->form->opr);
			$this->msgs->addInfo('Parametry poprawne.');
                        
                        //wykonanie operacji
                        $this->result->result = ($this->form->kredyt + ($this->form->kredyt * $this->form->opr/100)) / ($this->form->okr_kr*12);
			
			 $this->msgs->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		global $conf;
		
		$smarty = new Smarty\Smarty;
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','Przykład 05');
		$smarty->assign('page_description','Jeden kontroler wejścia.');
		$smarty->assign('page_header','Obiekty w PHP');
				
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/calc/CalcView.html');
	}
}
