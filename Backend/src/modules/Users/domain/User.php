<?php
namespace App\Modules\Users\Domain;

class User
{
    public Int $id;
    public String $username;
    public String $password;
    public String $email;
    public Bool $status;

    public function __construct()
    {
        $this->id = 0;
    }
}