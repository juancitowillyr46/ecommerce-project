<?php
namespace App\Modules\SignIn\Domain\Exceptions;

interface SignInValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array;
}