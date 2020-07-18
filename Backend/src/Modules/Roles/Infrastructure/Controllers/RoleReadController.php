<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleDTORequest;
use App\Modules\Roles\Application\RoleFindUseCase;

use DI\Container;
use Slim\Http\Response;

class RoleReadController extends BaseController
{
    private RoleFindUseCase $roleUseCase;

    public function __construct(RoleFindUseCase $roleUseCase, Container $container)
    {
        parent::__construct($container);


        $this->roleUseCase = $roleUseCase;
    }

    protected function execute(): Response
    {
        try {

            $args = $this->getArgs();

            $roleDTORequest = new RoleDTORequest($args);
            $roleDTORequest->id = (int) $args['id'];
            $execute = $this->roleUseCase->execute($roleDTORequest);

            return $this->Ok($execute);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        } catch (\Error $e) {

            $concat = $e->getMessage() .' - '.  $e->getCode() .' - '. $e->getFile().' - '. $e->getLine();

            $this->logger->error($concat);

            return $this->ServerError();

        }
    }
}