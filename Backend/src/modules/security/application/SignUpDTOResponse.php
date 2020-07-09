<?php


namespace App\modules\security\application;


use App\modules\security\domain\SignUp;

class SignUpDTOResponse
{
    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct(SignUp $signUp)
    {
        $this->id = $signUp->id;
        $this->username = $signUp->username;
        $this->password = $signUp->password;
        $this->email = $signUp->email;
    }
}