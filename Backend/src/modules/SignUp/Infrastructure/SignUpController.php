<?php
namespace App\Modules\SignUp\Infrastructure;
use App\Core\Infrastructure\Http\BaseController;
use App\Modules\SignUp\Application\SignUpDTO;
use App\Modules\SignUp\Application\SignUpUseCase;
use Slim\Http\Response;
use Exception;

class SignUpController extends BaseController
{
    private SignUpUseCase $signUpUseCase;

    public function __construct(SignUpUseCase $signUpUseCase)
    {
        $this->signUpUseCase = $signUpUseCase;
    }

    protected function execute(): Response {

        try {

            $data = $this->request->getParsedBody();
            $execute = $this->signUpUseCase->execute(new SignUpDTO($data));
            return $this->Ok($execute);

        } catch(\Exception $e) {

            return $this->BadRequest($e->getMessage());
        }

    }

}