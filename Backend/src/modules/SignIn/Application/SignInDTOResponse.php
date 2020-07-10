<?php
namespace App\Modules\SignIn\Application;

use App\Modules\SignIn\Domain\SignIn;

class SignInDTOResponse
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;

    public function __construct(SignIn $signIn)
    {
        $this->id = $signIn->id;
        $this->username = $signIn->username;
        $this->password = $signIn->password;
        $this->email = $signIn->email;
    }

}