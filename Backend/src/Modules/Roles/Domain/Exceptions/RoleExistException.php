<?php
namespace App\Modules\Roles\Domain\Exceptions;

use App\Modules\Roles\Domain\Exceptions\RoleExceptionMessage;
use Exception;

class RoleExistException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = RoleExceptionMessage::EXIST;
        parent::__construct($message, $code);
    }
}