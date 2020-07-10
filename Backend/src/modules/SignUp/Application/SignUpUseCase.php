<?php
namespace App\Modules\SignUp\Application;

use App\Core\infrastructure\security\EncryptPassword;
use App\Modules\SignUp\Domain\SignUpRepository;
use App\Modules\SignUp\Domain\SignUpUserExistException;

class SignUpUseCase
{
    private SignUpRepository $signUpRepository;

    public function __construct(SignUpRepository $ISignUpRepository)
    {
        $this->signUpRepository = $ISignUpRepository;
    }

    public function execute(SignUpDTO $signUpDTO): SignUpDTOResponse {

        $exist = $this->signUpRepository->isExistEmail($signUpDTO);
        if($exist == true){
            throw new SignUpUserExistException();
        } else {

            $signUpDTO->password = EncryptPassword::encrypt($signUpDTO->password);

            $signUp = $this->signUpRepository->register($signUpDTO);

            $signUpDTOResponse = new SignUpDTOResponse($signUp);

        }

        return $signUpDTOResponse;
    }
}