<?php


namespace App\modules\security\infrastructure\persistence;


use App\modules\security\application\SignInDTO;
use App\modules\security\domain\ISignInRepository;
use App\modules\security\domain\SignIn;

class EloquentSignInRepository implements ISignInRepository
{

    public function findUserByUsername(SignInDTO $signInDTO): SignIn
    {
        $signIn = new SignIn();

        if($signInDTO->username == "juan.rodas.manez@gmail.com") {
            $signIn->id = 1;
            $signIn->username = "juan.rodas.manez@gmail.com";
            $signIn->email = "juan.rodas.manez@gmail.com";
            $signIn->password = '$2y$10$WxwphhXu3/xMZcSJDUfIE.CIPTzPoSEHP7TR3QuFz8PwD4D8qR5J6';
        }

        return $signIn;
    }
}