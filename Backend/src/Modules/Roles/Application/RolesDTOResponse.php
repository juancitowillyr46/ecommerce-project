<?php


namespace App\Modules\Roles\Application;


use App\Modules\Roles\Domain\Role;

class RolesDTOResponse
{
    public function __construct(array $roles)
    {
        return $roles;
    }
}