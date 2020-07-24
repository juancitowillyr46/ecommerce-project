<?php
namespace App\Modules\Roles\Domain\Entities;

class Role
{
    public int $id;
    public string $name;
    public bool $active;
    public string $updated_at;
    public string $created_at;
    public string $description;
    public string $uuid;
}