<?php
namespace App\Core\Infrastructure\Security;

use DateTime;
use Firebase\JWT\JWT;

final class JwtCustom
{

    private string $exp;
    private string $secretKey;

    public function __construct(string $secretKey, string $exp)
    {
        $this->exp = $exp;
        $this->secretKey = $secretKey;
    }

    public function geToken($payload): string
    {

        try {

            $future = new DateTime($this->exp);
            $payload['exp'] = $future->getTimeStamp();
            return JWT::encode($payload, $this->secretKey);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }

    }

    public function decodeToken(string $jwt): object
    {
        return JWT::decode($jwt, $this->secretKey, array('HS256'));
    }
}