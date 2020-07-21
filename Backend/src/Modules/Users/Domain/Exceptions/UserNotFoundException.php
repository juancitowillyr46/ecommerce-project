<?php


namespace App\Modules\Users\Domain\Exceptions;


class UserNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0) {
        $message = UserExceptionMessage::USER_NOT_FOUND;
        parent::__construct($message, $code);
    }
}