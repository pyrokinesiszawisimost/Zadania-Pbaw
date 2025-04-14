<?php
namespace app\controll;

use app\forms\CalcForm;
use app\outpt\CalcRes;


class CalcCtrl{
    private $form;
    private $result;

    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcRes();
    }

    public function getParams(){
        $this->form->kwota = getFromRequest('kwota');
        $this->form->proc = getFromRequest('proc');
        $this->form->years = getFromRequest('years');
    }

    public function validate(){
        if(!(isset($this->form->kwota) && isset($this->form->years) && isset($this->form->proc))) return false;
        getMessages()->addInfos ("Przekazano parametry.");

        if($this->form->kwota == "") getMessages()->addErrors("Nie podano kwoty.");
        if($this->form->years == "") getMessages()->addErrors("Nie podano ilośći lat.");
        if($this->form->proc == "")  getMessages()->addErrors("Nie podano oprocentowania.");

        if (getMessages()->isErrors()) {
            if (! is_numeric( $this->form->kwota )) getMessages()->addErrors('Kwota nie jest liczbą');
            if (! is_numeric( $this->form->proc )) getMessages()->addErrors('Ilość lat nie jest liczbą');
            if (! is_numeric( $this->form->years )) getMessages()->addErrors('Oprocentowanie nie jest liczbą');
        }

        return !getMessages()->isErrors();
    }

    public function action_calcCompute(){
        $this->getParams();

        if($this->validate()){
            $this->form->kwota = intval($this->form->kwota);
            $this->form->proc = floatval($this->form->proc);
            $this->form->years = intval($this->form->years);
            getMessages()->addInfos('Parametry poprawne.');

            $this->result->res = ($this->form->kwota + ($this->form->kwota * $this->form->proc/100)) / ($this->form->years*12);

            getMessages()->addInfos("Wykonano obliczenia.");
        }
        $this->genView();
    }

    public function action_calcShow(){
        getMessages()->addInfos("Witaj w kalkulatorze");
        $this->genView();
    }
    public function genView(){
		
		getSmarty()->assign('page_title','Lab_06');
		getSmarty()->assign('page_description','Moja apka z nową strukturą');
		getSmarty()->assign('page_header','Laboratorium 6');
				
		
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('result',$this->result);
		
		getSmarty()->display('CalcView.tpl');
    }

}