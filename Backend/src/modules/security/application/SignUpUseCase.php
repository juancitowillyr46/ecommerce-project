<?php


namespace App\modules\security\application;

use App\core\infrastructure\security\EncryptPassword;
use App\modules\security\domain\ISignUpRepository;
use Exception;
class SignUpUseCase
{
    private $signUpRepository;

    public function __construct(ISignUpRepository $ISignUpRepository)
    {
        $this->signUpRepository = $ISignUpRepository;
    }

    public function execute(SignUpDTO $signUpDTO): SignUpDTOResponse {

        $exist = $this->signUpRepository->isExistEmail($signUpDTO);
        if($exist == true){
            throw new \Exception('El usuario ya existe');
        } else {

            $signUpDTO->password = EncryptPassword::encrypt($signUpDTO->password);

            $signUp = $this->signUpRepository->register($signUpDTO);

            $signUpDTOResponse = new SignUpDTOResponse($signUp);

        }

        return $signUpDTOResponse;
    }
}