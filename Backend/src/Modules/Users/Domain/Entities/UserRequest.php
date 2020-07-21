<?php
namespace App\Modules\Users\Domain\Entities;

class UserRequest
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $active;
    public int $statusId;
    public int $roleId;
}