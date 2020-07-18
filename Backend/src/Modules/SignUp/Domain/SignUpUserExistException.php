<?php
namespace App\Modules\SignUp\Domain;

use App\Modules\SignUp\Infrastructure\SignUpExceptionMessage;
use Exception;

class SignUpUserExistException  extends Exception
{

    public function __construct($message = "", $code = 0) {

        $message = SignUpExceptionMessage::SIGN_UP_EXIST;

        parent::__construct($message, $code);
    }
}