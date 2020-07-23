<?php
namespace App\Modules\Users\Domain\Entities;

class UserResponse
{
    public int $id;
    public string $username;
    public string $email;
    public string $active;
    public string $role;
}