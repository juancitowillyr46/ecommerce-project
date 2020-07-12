<?php
namespace App\Modules\Roles\Application;

use App\Modules\Roles\Domain\Role;
use Carbon\Carbon;

class RoleDTORequest
{
    public int $id;
    public string $name;
    public bool $active;
    public Carbon $createdAt;
    public Carbon $updatedAt;

    public function __construct(array $role)
    {
       $this->matchKey($role);
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "active" => $this->active,
            "created_at" => $this->createdAt,
            "updated_at" => ($this->id > 0)? $this->updatedAt : null
        ];
    }

    public function matchKey(array $role)
    {
        $this->id = (array_key_exists("id", $role))? $role["id"] : 0;
        $this->name = (array_key_exists("name", $role))? $role["name"] : "";
        $this->active = (array_key_exists("active", $role))? $role["active"] : "";
        $this->createdAt = Carbon::now();
        if($this->id > 0){
            $this->updatedAt = Carbon::now();
        }

    }


}