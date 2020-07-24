<?php
namespace App\Modules\SignIn\Application\UseCase;

use App\core\Infrastructure\Security\EncryptPassword;
use App\Modules\SignIn\Application\SignInUseCaseInterface;
use App\Modules\SignIn\Domain\Entities\SignIn;
use App\Modules\SignIn\Domain\Entities\SignInPayload;
use App\Modules\SignIn\Domain\Entities\SignInRequest;
use App\Modules\SignIn\Domain\Entities\SignInResponse;
use App\Modules\SignIn\Domain\Exceptions\SignInPasswordIncorrectException;
use DateTime;

class SignInUseCase extends SignInUseCaseImp implements SignInUseCaseInterface
{

    private SignIn $signIn;

    public function __invoke(SignInRequest $signInRequest): SignInResponse
    {

        $this->signIn = $this->signInRepository->findUserByUsername($signInRequest);

        $isPasswordCorrect = EncryptPassword::verify($signInRequest->password, $this->signIn->password);

        if(!$isPasswordCorrect) {
            throw new SignInPasswordIncorrectException();
        }

        try {

            $response = new SignInResponse();
            $response->token = $this->generateToken();
            return $response;

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());
        }

    }

    public function generateToken(): string
    {
        $now = new DateTime();

        $payload = new SignInPayload(array(
            "iat" => $now->getTimeStamp(),
            "sub" => $this->signIn->uuid
        ));

        try {

            return $this->jwtCustom->geToken($payload->getPayload());

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }
    }

}