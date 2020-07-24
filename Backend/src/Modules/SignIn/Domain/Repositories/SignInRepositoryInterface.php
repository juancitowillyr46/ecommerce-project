<?php
namespace App\Modules\SignIn\Domain\Repositories;

use App\Modules\SignIn\Domain\Entities\SignIn;
use App\Modules\SignIn\Domain\Entities\SignInRequest;

interface SignInRepositoryInterface
{
    public function findUserByUsername(SignInRequest $signInRequest): SignIn;
}