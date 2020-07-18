<?php


namespace App\Modules\Roles\Infrastructure\Controllers;


use App\Core\Application\BaseRequest;
use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleDTORequest;
use App\Modules\Roles\Application\RoleRemoveUseCase;
use App\Modules\Roles\Domain\Role;
use DI\Container;
use Slim\Http\Response;

class RoleDeleteController extends BaseController
{
    private RoleRemoveUseCase $roleUseCase;
    private BaseRequest $dtoRequest;

    public function __construct(RoleRemoveUseCase $roleUseCase, Container $container, BaseRequest $dtoRequest)
    {
        parent::__construct($container);
        $this->roleUseCase = $roleUseCase;
    }

    protected function execute(): Response
    {
        try {

            // FormRequest
            // Argumentos
            // $roleDTORequest = new RoleDTORequest($args);
            // $roleDTORequest->id = (int) $args['id'];
            // $dtoRequest = new BaseRequest();
            // $args = $this->getArgs();

            $this->dtoRequest->setData($this->getParsedBody());

            $execute = $this->roleUseCase->execute($this->dtoRequest);

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