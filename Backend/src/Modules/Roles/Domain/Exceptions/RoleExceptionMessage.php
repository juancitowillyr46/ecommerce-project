<?php
namespace App\Modules\Roles\Domain\Exceptions;

class RoleExceptionMessage
{
    const NOT_FOUND = "Hubo un problema";
    const EXIST = "El role ya existe";
    const NOT_EXIST = "El role no existe";
}