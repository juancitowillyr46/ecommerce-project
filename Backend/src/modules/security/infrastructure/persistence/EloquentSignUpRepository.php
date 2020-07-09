<?php


namespace App\modules\security\infrastructure\persistence;


use App\modules\security\application\SignUpDTO;
use App\modules\security\domain\ISignUpRepository;
use App\modules\security\domain\SignUp;

class EloquentSignUpRepository implements ISignUpRepository
{

    public function register(SignUpDTO $signUpDTO): SignUp
    {
        $signUpSave = new SignUp();
        $signUpSave->id = 1;
        $signUpSave->username = $signUpDTO->username;
        $signUpSave->password = $signUpDTO->password;
        $signUpSave->email = $signUpDTO->email;
        return $signUpSave;
    }

    public function isExistEmail(SignUpDTO $signUpDTO): Bool
    {
        if($signUpDTO->email === "juan.rodas.manez@gmail.com1"){
            return true;
        }
        return false;
    }
}