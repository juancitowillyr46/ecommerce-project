<?php

namespace App\modules\security\application;


use App\core\infrastructure\security\EncryptPassword;
use App\modules\security\domain\ISignInRepository;
use App\modules\security\domain\SignInNotExistException;
use App\modules\security\domain\SignInPasswordIncorrectException;

class SignInUseCase
{
    private $signInRepository;

    public function __construct(ISignInRepository $ISignInRepository)
    {
        $this->signInRepository = $ISignInRepository;
    }

    public function execute(SignInDTO $signInDTO): SignInDTOResponse {

        $signIn = $this->signInRepository->findUserByUsername($signInDTO);

        if($signIn->id == 0){
            throw new SignInNotExistException('El usuario no existe');
        } else {

            $verifyPassword = EncryptPassword::verify($signInDTO->password, $signIn->password);

            if(!$verifyPassword) {
                throw new SignInPasswordIncorrectException('El password es incorrecto');
            } else {
                $signInDTOResponse = new SignInDTOResponse($signIn);
            }
        }

        return $signInDTOResponse;
    }

}