<?php


namespace App\Modules\Users\Infrastructure;


use App\Modules\Users\Domain\Exceptions\UserValidatorInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserValidator implements UserValidatorInterface
{

    public function validatorParsedBody(\stdClass $body): array
    {
        $message = [];

        try {

            $userValidator = v::attribute('username', v::notEmpty())->
            attribute('password', v::notEmpty())->
            attribute('email', v::notEmpty())->
            attribute('active', v::boolVal())->
            attribute('roleUuid', v::notEmpty());
            $userValidator->assert($body);

        }  catch(NestedValidationException $e) {

            $message = $e->getMessages();

        }

        return $message;
    }
}