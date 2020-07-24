<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleRemoveUseCase;
use App\Modules\Roles\Domain\Entities\RoleMapperInterface;
use App\Modules\Roles\Domain\Exceptions\RoleValidatorInterface;
use App\Modules\Roles\Infrastructure\RoleMessageController;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class RoleDeleteController extends BaseController
{
    protected RoleUseCaseInterface $useCase;
    protected RoleMapperInterface $roleMapper;
    protected LoggerInterface $logger;
    protected RoleValidatorInterface $roleValidator;

    public function __construct(RoleRemoveUseCase $useCase, RoleMapperInterface $roleMapper, LoggerInterface $logger, RoleValidatorInterface $roleValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->roleMapper = $roleMapper;
        $this->roleValidator = $roleValidator;
        parent::__construct($logger);
    }

    public function execute(): Response
    {
        try {

            $args = (object) $this->getArgs();

            $uuid = $this->useCase->__invoke($args->uuid);

            return $this->Ok(new ResponseSuccessController(RoleMessageController::REMOVE, $uuid));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));

        }
    }
}