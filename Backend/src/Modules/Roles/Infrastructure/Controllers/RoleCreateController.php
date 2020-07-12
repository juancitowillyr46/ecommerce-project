<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleCreateUseCase;
use DI\Container;
use Monolog\Logger;
use Slim\Http\Response;

class RoleCreateController extends BaseController
{
    private RoleCreateUseCase $roleUseCase;

    public function __construct(RoleCreateUseCase $roleUseCase, Container $container)
    {
        parent::__construct($container);
        $this->roleUseCase = $roleUseCase;
    }

    protected function execute(): Response
    {
        try {

            $parsedBody = $this->getParsedBody();

            $roleDTORequest = $this->roleUseCase->validate($parsedBody);

            $execute = $this->roleUseCase->execute($roleDTORequest);

            return $this->Ok($execute);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        } catch (\Error $e) {

            return $this->ServerError();

        }
    }

}