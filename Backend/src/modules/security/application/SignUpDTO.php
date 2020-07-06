<?php


namespace App\modules\security\application;


class SignUpDTO
{
    public function __construct(array $getParsedBody)
    {
        $this->username = $getParsedBody['username'];
        $this->password = $getParsedBody['password'];
        $this->email = $getParsedBody['email'];
    }

    public $username;
    public $password;
    public $email;
}