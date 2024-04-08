<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';


class CalcCtrl {

	private $msgs;    
	private $form;    
	private $result;  
	private $hide_intro; 


	public function __construct(){
		
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
		$this->hide_intro = false;
	}
	

	public function getParams(){
		$this->form->kredyt = isset($_REQUEST ['kredyt']) ? $_REQUEST ['kredyt'] : null;
		$this->form->okr_kr = isset($_REQUEST ['okr_kr']) ? $_REQUEST ['okr_kr'] : null;
		$this->form->opr = isset($_REQUEST ['opr']) ? $_REQUEST ['opr'] : null;
	}
	
	public function validate() {
		
		if (! (isset ( $this->form->kredyt ) && isset ( $this->form->okr_kr ) && isset ( $this->form->opr ))) {
			
			return false; 
		} else { 
			$this->hide_intro = true; 
		}
		
		
		if ($this->form->kredyt == "") {
			$this->msgs->addError('Nie podano liczby 1');
		}
		if ($this->form->okr_kr == "") {
			$this->msgs->addError('Nie podano liczby 2');
		}
		if ($this->form->opr == "") {
			$this->msgs->addError('Nie podano liczby 3')
		}
		
		
		if (! $this->msgs->isError()) {
			
			
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
	
	
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			 this->form->kredyt = intval($this->form->kredyt);
			 this->form->okr_kr = intval($this->form->okr_kr);
			 this->form->opr intval($this->form->opr;			
			 this->msgs->addInfo('Parametry poprawne.');
				
			 $this->result->result = ($this->form->kredyt + ($this->form->kredyt * $this->form->opr/100)) / ($this->form->okr_kr*12);
			
			 $this->msgs->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	

	public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','Przykład 05');
		$smarty->assign('page_description','Obiektowość. Funkcjonalność aplikacji zamknięta w metodach różnych obiektów. Pełen model MVC.');
		$smarty->assign('page_header','Obiekty w PHP');
				
		$smarty->assign('hide_intro',$this->hide_intro);
		
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/CalcView.html');
	}
}
