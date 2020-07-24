<?php
namespace App\Modules\SignIn\Infrastructure;

use App\Modules\SignIn\Domain\Exceptions\SignInValidatorInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class SignInValidator implements SignInValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array
    {
        $message = [];

        try {

            $userValidator = v::attribute('username', v::notEmpty())->
            attribute('password', v::notEmpty());
            $userValidator->assert($body);

        }  catch(NestedValidationException $e) {

            $message = $e->getMessages();

        }

        return $message;
    }
}