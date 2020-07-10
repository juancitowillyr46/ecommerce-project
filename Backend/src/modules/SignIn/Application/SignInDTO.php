<?php
namespace App\Modules\SignIn\Application;

class SignInDTO
{
    public string $username;
    public string $password;

    public function __construct(Array $requestData)
    {
        $this->username = $requestData['username'];
        $this->password = $requestData['password'];
    }

}