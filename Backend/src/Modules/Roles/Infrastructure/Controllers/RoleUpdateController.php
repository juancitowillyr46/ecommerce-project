<?php
namespace App\Modules\Roles\Infrastructure\Controllers;


use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleUpdateUseCase;
use DI\Container;
use Monolog\Logger;
use Slim\Http\Response;

class RoleUpdateController extends BaseController
{
    private RoleUpdateUseCase $roleUseCase;

    public function __construct(RoleUpdateUseCase $roleUseCase, Container $container)
    {
        parent::__construct($container);
        $this->roleUseCase = $roleUseCase;
    }

    protected function execute(): Response
    {
        try {

            $parsedBody = $this->getParsedBody();

            $args = $this->getArgs();

            $roleDTORequest = $this->roleUseCase->validate($parsedBody);
            $roleDTORequest->id = $args['id'];
            $execute = $this->roleUseCase->execute($roleDTORequest);

            return $this->Ok($execute);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        } catch (\Error $e) {

            return $this->ServerError();

        }
    }
}