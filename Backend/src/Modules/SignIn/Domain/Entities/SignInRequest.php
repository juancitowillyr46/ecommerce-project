<?php
namespace App\Modules\SignIn\Domain\Entities;

class SignInRequest
{
    public string $username;
    public string $password;
}