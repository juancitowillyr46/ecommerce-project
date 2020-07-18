<?php


namespace App\Modules\SignUp\Infrastructure\Persistence;


use App\Modules\SignUp\Application\SignUpDTO;
use App\Modules\SignUp\Domain\SignUpRepository;
use App\Modules\SignUp\Domain\SignUp;

class EloquentSignUpRepository implements SignUpRepository
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