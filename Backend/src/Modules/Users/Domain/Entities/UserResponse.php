<?php
namespace App\Modules\Users\Domain\Entities;

class UserResponse
{
    public string $username;
    public string $email;
    public string $active;
    public string $role;
    public string $uuid;
}