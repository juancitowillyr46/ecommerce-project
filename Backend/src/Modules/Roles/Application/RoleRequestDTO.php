<?php
namespace App\Modules\Roles\Application;
use App\Core\Application\BaseRequest;

class RoleRequestDTO
{
    public int $id;
    public string $name;
    public bool $active;
//    public string $updatedAt;
//    public string $createdAt;
    public string $descriptionRole;
}