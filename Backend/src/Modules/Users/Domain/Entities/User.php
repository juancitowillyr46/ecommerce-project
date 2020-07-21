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
    public int $status_id;
    public int $role_id;
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        $this->id = 0;
    }
}