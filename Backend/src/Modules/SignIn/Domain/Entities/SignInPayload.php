<?php
namespace App\Modules\SignIn\Domain\Entities;

class SignInPayload
{

    private array $getPayload;

    public function __construct(array $getPayload)
    {
        $this->getPayload = $getPayload;
    }

    public function getPayload()
    {
        return $this->getPayload;
    }

}