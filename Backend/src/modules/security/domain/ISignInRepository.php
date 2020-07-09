<?php


namespace App\modules\security\domain;


use App\modules\security\application\SignInDTO;

interface ISignInRepository
{
    public function findUserByUsername(SignInDTO $signInDTO): SignIn;
}