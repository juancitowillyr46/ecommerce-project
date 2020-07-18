<?php
namespace App\Modules\SignUp\Application;


class SignUpDTO
{

    public string $username;
    public string $password;
    public string $email;

    public function __construct(array $getParsedBody)
    {
        $this->username = $getParsedBody['username'];
        $this->password = $getParsedBody['password'];
        $this->email = $getParsedBody['email'];
    }

}