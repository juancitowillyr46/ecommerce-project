<?php


namespace App\Modules\Users\Application;


class UserDTORequest
{
    public Int $id;
    public String $username;
    public String $password;
    public String $email;
    public Bool $status;

    public function __construct(array $data)
    {
        $this->id = (Int) $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->status = $data['status'];
    }
}