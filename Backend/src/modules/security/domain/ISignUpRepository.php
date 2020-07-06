<?php


namespace App\modules\security\domain;


use App\modules\security\application\SignUpDTO;

interface ISignUpRepository
{
    public function register(SignUpDTO $signUp): SignUp;
    public function isExist(SignUpDTO $signUp): Bool;
}