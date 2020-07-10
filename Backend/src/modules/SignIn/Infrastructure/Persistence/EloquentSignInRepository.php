<?php
namespace App\Modules\SignIn\Infrastructure\Persistence;

use App\Modules\SignIn\application\SignInDTO;
use App\Modules\SignIn\Domain\SignIn;
use App\Modules\SignIn\Domain\SignInRepository;

class EloquentSignInRepository implements SignInRepository
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