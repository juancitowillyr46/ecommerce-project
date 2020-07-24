<?php
namespace App\Modules\Roles\Domain\Exceptions;

interface RoleValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array;
}