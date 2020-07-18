<?php
namespace App\Modules\Users\Application;

class UserDTORequest
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public int $statusId;
    public bool $active;
    public int $roleId;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->statusId = $data['statusId'];
        $this->active = $data['active'];
        $this->roleId = $data['roleId'];
    }
}