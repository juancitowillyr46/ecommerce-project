<?php


namespace App\modules\security\domain;


class SignIn
{

    public function __construct()
    {
        $this->id = 0;
    }

    public $id;

    public $username;

    public $password;

    public $email;

}