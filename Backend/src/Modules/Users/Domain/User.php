<?php
namespace App\Modules\Users\Domain;

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $status_id;
    public bool $active;
    public string $token_activate;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public \DateTime $deleted_at;
    public int $role_id;

    public function __construct()
    {
        $this->id = 0;
    }
}