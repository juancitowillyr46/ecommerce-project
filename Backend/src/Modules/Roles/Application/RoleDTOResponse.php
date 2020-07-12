<?php


namespace App\Modules\Roles\Application;


use App\Modules\Roles\Domain\Role;
use Carbon\Carbon;

class RoleDTOResponse
{
    public int $id;
    public string $name;
    public Carbon $createdAt;
    public string $active;

    public function __construct(Role $role)
    {
        $this->id = $role->id;
        $this->name = $role->name;
        $this->active = ($role->active == true)? "ACTIVO" : "NO ACTIVO";
    }
}