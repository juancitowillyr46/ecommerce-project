<?php

namespace App\modules\security\application;


use App\modules\security\domain\SignIn;

class SignInUseCase
{

    public function execute(SignIn $signInDTO) {
        return $signInDTO;
    }

}