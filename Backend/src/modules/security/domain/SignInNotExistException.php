<?php


namespace App\modules\security\domain;

use Exception;

class SignInNotExistException extends Exception
{

    public function __construct($message = "", $code = 0) {

        $message = ExceptionMessage::SIGN_IN_NOT_EXIST;

        parent::__construct($message, $code);
    }
}