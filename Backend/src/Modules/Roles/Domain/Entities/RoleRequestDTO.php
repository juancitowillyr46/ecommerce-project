<?php
namespace App\Modules\Roles\Domain\Entities;

class RoleRequestDTO
{
    public string $name;
    public bool $active;
    public string $description;
    public string $uuid;
}