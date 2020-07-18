<?php


namespace App\Modules\SignIn\Domain;


use App\Modules\SignIn\application\SignInDTO;

interface SignInRepository
{
    public function findUserByUsername(SignInDTO $signInDTO): SignIn;
}