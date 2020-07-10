<?php


namespace App\Modules\Users\Application;


use App\Modules\Users\Domain\User;

class UserDTOResponse
{
    public Int $id;
    public String $username;
    public String $password;
    public String $email;
    public Bool $status;

    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->username = $user->username;
        $this->password = $user->password;
        $this->email = $user->email;
        $this->status = $user->status;
    }
}