<?php
namespace App\Modules\SignIn\Domain\Exceptions;

use App\Modules\SignIn\Infrastructure\SignInExceptionMessage;
use Exception;

class SignInPasswordIncorrectException extends Exception
{
    public function __construct($message = "", $code = 0) {

        $message = SignInExceptionMessage::SIGN_IN_INCORRECT_PASSWORD;

        parent::__construct($message, $code);
    }
}