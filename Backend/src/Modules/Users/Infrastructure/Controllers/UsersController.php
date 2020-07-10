<?php
namespace App\Modules\Users\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Users\Application\Manager\UserCreateUseCase;
use App\Modules\Users\Application\UserDTORequest;
use Slim\Http\Response;

class UsersController  extends BaseController
{

    private UserCreateUseCase $userCreateUseCase;

    public function __construct(UserCreateUseCase $userCreateUseCase)
    {
        $this->userCreateUseCase = $userCreateUseCase;
    }

    protected function execute(): Response
    {
        try {

            $data = $this->request->getParsedBody();

            $execute = $this->userCreateUseCase->execute(new UserDTORequest($data));

            return $this->Ok($execute);

        } catch(\Exception $e) {

            return $this->BadRequest($e->getMessage());
        }
    }
}