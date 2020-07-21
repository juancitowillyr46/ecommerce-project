<?php
namespace App\Modules\Users\Domain\Exceptions;

class UserExceptionMessage
{
    const USER_NOT_FOUND = "EXISTE UN PROBLEMA AL REGISTRAR";
    const USER_EXIST = "EL USUARIO SE ENCUENTRA REGISTRADO";
    const USER_NOT_EXIST = "EL USUARIO NO EXISTE";
}