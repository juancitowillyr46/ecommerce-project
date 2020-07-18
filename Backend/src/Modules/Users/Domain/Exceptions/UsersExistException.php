<?php
namespace App\Modules\Users\Domain\Exceptions;

use App\Modules\Users\Infrastructure\UsersExceptionMessage;
use Exception;

class UsersExistException extends Exception
{

    public function __construct($message = "", $code = 0) {

        $message = UsersExceptionMessage::USERS_EXIST;

        parent::__construct($message, $code);
    }
}