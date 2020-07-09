<?php


namespace App\modules\security\application;


class SignInDTO
{

    public function __construct(array $requestData)
    {
        $this->username = $requestData['username'];
        $this->password = $requestData['password'];
    }

    public $username;
    public $password;
}