<?php


namespace App\modules\security\application;


use App\modules\security\domain\SignIn;

class SignInDTOResponse
{
    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct(SignIn $signIn)
    {
        $this->id = $signIn->id;
        $this->username = $signIn->username;
        $this->password = $signIn->password;
        $this->email = $signIn->email;
    }

}