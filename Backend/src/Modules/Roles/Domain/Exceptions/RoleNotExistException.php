<?php
namespace App\Modules\Roles\Domain\Exceptions;

use Exception;

class RoleNotExistException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = RoleExceptionMessage::NOT_EXIST;
        parent::__construct($message, $code);
    }
}