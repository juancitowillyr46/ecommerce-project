<?php
namespace App\Modules\SignIn\Domain\Entities;

class SignInResponse
{
    public string $token;
    public object $decode;
}