<?php
namespace App\Modules\Roles\Domain;

class Role
{
    public int $id;
    public string $name;
    public bool $active;
    public string $updated_at;
    public string $created_at;
    public string $description_role;
}