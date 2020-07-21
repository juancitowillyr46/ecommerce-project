<?php


namespace App\Modules\Users\Domain\Exceptions;


class UserNotExistException extends \Exception
{
    public function __construct($message = "", $code = 0) {
        $message = UserExceptionMessage::USER_EXIST;
        parent::__construct($message, $code);
    }
}