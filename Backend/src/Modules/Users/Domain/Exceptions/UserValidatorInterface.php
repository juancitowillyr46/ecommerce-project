<?php
namespace App\Modules\Users\Domain\Exceptions;

interface UserValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array;
}