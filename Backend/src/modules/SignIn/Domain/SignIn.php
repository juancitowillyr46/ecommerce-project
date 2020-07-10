<?php
namespace App\Modules\SignIn\Domain;


class SignIn
{

    public int $id;

    public string $username;

    public string $password;

    public string $email;

    public function __construct()
    {
        $this->id = 0;
    }

}