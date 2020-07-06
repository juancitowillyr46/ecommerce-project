<?php


namespace App\modules\security\application;

use App\modules\security\domain\ISignUpRepository;
use Exception;
class SignUpUseCase
{
    private $signInRepository;

    public function __construct(ISignUpRepository $ISignUpRepository)
    {
        $this->signInRepository = $ISignUpRepository;
    }

    public function execute(SignUpDTO $signUpDTO) {

        $exist = $this->signInRepository->isExist($signUpDTO);
        if($exist == true){
            throw new \Exception('El usuario ya existe');
        }


        return $signUpDTO;
    }
}