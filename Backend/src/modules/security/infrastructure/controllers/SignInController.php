<?php

namespace App\modules\security\infrastructure\controllers;




use App\core\infrastructure\http\BaseController;
use App\modules\security\application\SignInDTO;
use App\modules\security\application\SignInUseCase;
use App\modules\security\domain\SignIn;
use Slim\Http\Response;

class SignInController extends BaseController
{
    private $signInUseCase;

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