<?php
namespace App\Modules\Users\Domain\Entities;

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $active;
    public string $token_active;
    public int $role_id;
    public string $created_at;
    public string $updated_at;
    public array $role;
    public string $uuid;

    public function __construct()
    {
        $this->id = 0;
        $this->role = [];
    }
}