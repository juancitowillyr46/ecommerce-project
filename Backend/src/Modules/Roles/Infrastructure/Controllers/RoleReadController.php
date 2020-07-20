<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleFindUseCase;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleValidatorInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class RoleReadController extends BaseController
{
    protected RoleUseCaseInterface $useCase;
    protected RoleMapperInterface $roleMapper;
    protected LoggerInterface $logger;
    protected RoleValidatorInterface $roleValidator;

    public function __construct(RoleFindUseCase $useCase, RoleMapperInterface $roleMapper, LoggerInterface $logger, RoleValidatorInterface $roleValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->roleMapper = $roleMapper;
        $this->roleValidator = $roleValidator;

    }

    public function execute(): Response
    {
        try {

            $args = (object) $this->getArgs();
            $useCase = $this->useCase->__invoke($args->id);

            return $this->Ok($useCase);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        }
    }
}