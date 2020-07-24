<?php
namespace App\Modules\Users\Domain\Entities;

class UserRequest
{
//    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $active;
    public int $roleId;
//    public string $uuid;
    public string $roleUuid;
//    public string $roleUuid;

    public function __construct()
    {
        $this->uuid = "";
    }
}