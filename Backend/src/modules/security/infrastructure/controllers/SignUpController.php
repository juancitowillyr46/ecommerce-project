<?php
namespace App\modules\security\infrastructure\controllers;
use App\core\infrastructure\http\BaseController;
use App\modules\security\application\SignUpDTO;
use App\modules\security\application\SignUpUseCase;
use Slim\Http\Response;
use Exception;

class SignUpController extends BaseController
{
    private $signUpUseCase;

    public function __construct(SignUpUseCase $signUpUseCase)
    {
        $this->signUpUseCase = $signUpUseCase;
    }

    protected function execute(): Response {
        $data = $this->request->getParsedBody();
        try {

            $execute = $this->signUpUseCase->execute(new SignUpDTO($data));
            return $this->Ok($execute);

        } catch(Exception $e) {

            return $this->BadRequest($e->getMessage());
        }

    }

}