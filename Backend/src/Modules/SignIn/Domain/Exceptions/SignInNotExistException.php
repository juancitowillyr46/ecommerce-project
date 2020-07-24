<?php
namespace App\Modules\SignIn\Domain\Exceptions;

use App\Modules\SignIn\Infrastructure\SignInExceptionMessage;
use Exception;

class SignInNotExistException extends Exception
{

    public function __construct($message = "", $code = 0) {

        $message = SignInExceptionMessage::SIGN_IN_NOT_EXIST;

        parent::__construct($message, $code);
    }
}