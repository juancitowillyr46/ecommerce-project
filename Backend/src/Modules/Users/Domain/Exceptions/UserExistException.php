<?php
namespace App\Modules\Users\Domain\Exceptions;

use App\Modules\Users\Infrastructure\Persistence;
use Exception;

class UserExistException extends Exception
{
    public function __construct($message = "", $code = 0) {
        $message = UserExceptionMessage::USER_EXIST;
        parent::__construct($message, $code);
    }
}