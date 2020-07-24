<?php
namespace App\Modules\SignIn\Domain\Entities;


class SignIn
{

    public int $id;

    public string $uuid;

    public string $username;

    public string $password;

    public string $email;

    public function __construct()
    {
        $this->id = 0;
    }

}