<?php
namespace App\Modules\SignIn\Application;

use App\Core\infrastructure\security\EncryptPassword;
use App\Modules\SignIn\Domain\SignInNotExistException;
use App\Modules\SignIn\Domain\SignInPasswordIncorrectException;
use App\Modules\SignIn\Domain\SignInRepository;


class SignInUseCase
{
    private SignInRepository $signInRepository;

    public function __construct(SignInRepository $ISignInRepository)
    {
        $this->signInRepository = $ISignInRepository;
    }

    public function execute(SignInDTO $signInDTO): SignInDTOResponse {

        $signIn = $this->signInRepository->findUserByUsername($signInDTO);

        if($signIn->id == 0){
            throw new SignInNotExistException();
        } else {

            $verifyPassword = EncryptPassword::verify($signInDTO->password, $signIn->password);

            if(!$verifyPassword) {
                throw new SignInPasswordIncorrectException();
            } else {
                $signInDTOResponse = new SignInDTOResponse($signIn);
            }
        }

        return $signInDTOResponse;
    }

}