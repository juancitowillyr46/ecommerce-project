<?php

namespace App\Core\Infrastructure\Security;


class EncryptPassword
{
    public static function encrypt($password): String {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verify($password, $hash): Bool {
        return password_verify($password, $hash);
    }

}