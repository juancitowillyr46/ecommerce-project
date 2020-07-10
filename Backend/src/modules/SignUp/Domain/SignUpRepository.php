<?php
namespace App\Modules\SignUp\Domain;

use App\Modules\SignUp\Application\SignUpDTO;

interface SignUpRepository
{
    public function register(SignUpDTO $signUp): SignUp;
    public function isExistEmail(SignUpDTO $signUp): Bool;
}