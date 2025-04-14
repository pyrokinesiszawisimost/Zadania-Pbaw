<?php

namespace app\outpt;

class User{
    public $role;
    public $login;

    public function __construct($login, $role){
        $this->login = $login;
        $this->role = $role;
    }
}