<?php
namespace App\Modules\Roles\Domain;

class RoleRequestDTO
{
    public int $id;
    public string $name;
    public bool $active;
    public string $description;
}