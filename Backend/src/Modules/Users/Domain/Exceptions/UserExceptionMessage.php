<?php
namespace App\Modules\Users\Domain\Exceptions;

class UserExceptionMessage
{
    const USER_NOT_FOUND = "Hubo un problema";
    const USER_EXIST = "El usuario ya existe";
    const USER_NOT_EXIST = "El usuario no existe";
}