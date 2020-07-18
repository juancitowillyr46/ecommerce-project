<?php
namespace App\Core\Application;

interface UseCaseInterface
{
    public function validate(BaseRequest $baseRequest): array;
//    public function getLogger();
}