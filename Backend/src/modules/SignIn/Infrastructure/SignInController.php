<?php

namespace App\Modules\SignIn\Infrastructure;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\SignIn\Application\SignInDTO;
use App\Modules\SignIn\Application\SignInUseCase;
use Slim\Http\Response;

class SignInController extends BaseController
{
    private SignInUseCase $signInUseCase;

    public function __construct(SignInUseCase $signInUseCase)
    {
        $this->signInUseCase = $signInUseCase;
    }

    protected function execute(): Response {

        try {

            $data = $this->request->getParsedBody();
            $execute = $this->signInUseCase->execute(new SignInDTO($data));
            return $this->Ok($execute);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());
        }

    }

}