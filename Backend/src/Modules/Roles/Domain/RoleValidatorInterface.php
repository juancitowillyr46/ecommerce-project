<?php
namespace App\Modules\Roles\Domain;

interface RoleValidatorInterface
{
    public function validatorParsedBody(\stdClass $body): array;
}