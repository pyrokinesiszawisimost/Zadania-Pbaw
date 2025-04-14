<?php
namespace core;


class Messages{
    private $errors = array();
    private $infos = array();
    private $num = 0;

    public function addErrors($mess){
        $this->errors[] = $mess;
        $this->num++;
    }

    public function addInfos($mess){
        $this->infos[] = $mess;
        $this->num++;
    }

    public function isEmpty(){
        return $this->num == 0;
    }

    public function isErrors(){
        return count($this->errors)>0;
    }

    public function isInfos(){
        return count($this->infos)>0;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function getInfos(){
        return $this->infos;
    }

    public function clear(){
        $this->errors = array();
        $this->infos = array();
        $this->num = 0;
    }
}