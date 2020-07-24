<?php
namespace App\Modules\Roles\Domain\Exceptions;

use Exception;

class RoleNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = RoleExceptionMessage::NOT_FOUND;
        parent::__construct($message, $code);
    }
}