<?php
namespace App\Modules\Roles\Infrastructure;

use App\Modules\Roles\Domain\RoleValidatorInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Http\Response;

class RoleValidator implements RoleValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array
    {
        $message = [];

        try {

            $userValidator = v::attribute('id', v::intVal())->
            attribute('name', v::notEmpty())->
            attribute('active', v::boolVal())->
            attribute('description', v::notEmpty());
            $userValidator->assert($body);

        }  catch(NestedValidationException $e) {

            $message = $e->getMessages();

        }

        return $message;
    }

}