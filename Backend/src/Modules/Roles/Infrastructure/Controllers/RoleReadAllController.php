<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleDTORequest;
use App\Modules\Roles\Application\RoleReadAllUseCase;
use App\Modules\Roles\Application\RoleReadUseCase;
use DI\Container;
use Slim\Http\Response;

class RoleReadAllController extends BaseController
{
    private RoleReadAllUseCase $roleUseCase;

    public function __construct(RoleReadAllUseCase $roleUseCase, Container $container)
    {
        parent::__construct($container);


        $this->roleUseCase = $roleUseCase;
    }

    protected function execute(): Response
    {
        try {

            $execute = $this->roleUseCase->execute(new RoleDTORequest([]));

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