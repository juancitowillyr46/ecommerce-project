<?php


namespace App\modules\security\domain;


class SignIn
{

    public function __construct(array $getParsedBody)
    {
        $this->username = $getParsedBody['username'];
        $this->password = $getParsedBody['password'];
    }

    public $username;

    public $password;

}