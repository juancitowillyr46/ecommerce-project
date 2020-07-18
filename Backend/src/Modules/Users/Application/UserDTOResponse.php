<?php


namespace App\Modules\Users\Application;


use App\Modules\Users\Domain\User;

class UserDTOResponse
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public int $statusId;
    public bool $active;

    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->statusId = $user->status_id;
    }
}