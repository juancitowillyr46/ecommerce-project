<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleAddUseCase;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleValidatorInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class RoleCreateController extends BaseController
{
    protected RoleUseCaseInterface $useCase;
    protected RoleMapperInterface $roleMapper;
    protected LoggerInterface $logger;
    protected RoleValidatorInterface $roleValidator;

    public function __construct(RoleAddUseCase $useCase, RoleMapperInterface $roleMapper, LoggerInterface $logger, RoleValidatorInterface $roleValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->roleMapper = $roleMapper;
        $this->roleValidator = $roleValidator;

    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();

            $message = $this->roleValidator->validatorParsedBody($body);
            if(count($message) > 0){
                return $this->BadRequest($message);
            }

            $result = $this->roleMapper->getMapper()->map($body, RoleRequestDTO::class);
            $useCase = $this->useCase->__invoke($result);

            return $this->Ok($useCase);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        }
    }

}