<?php
namespace App\Modules\SignUp\Application;

use App\Modules\SignUp\Domain\SignUp;

class SignUpDTOResponse
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;

    public function __construct(SignUp $signUp)
    {
        $this->id = $signUp->id;
        $this->username = $signUp->username;
        $this->password = $signUp->password;
        $this->email = $signUp->email;
    }
}