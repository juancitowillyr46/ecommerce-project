<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleAddUseCase;
use App\Modules\Roles\Domain\Entities\RoleMapperInterface;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Exceptions\RoleValidatorInterface;
use App\Modules\Roles\Infrastructure\RoleMessageController;
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
        parent::__construct($logger);

    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();

            $message = $this->roleValidator->validatorParsedBody($body);
            if (count($message) > 0) {
                return $this->BadRequest(new ResponseErrorController($message, ''));
            }

            $result = $this->roleMapper->getMapper()->map($body, RoleRequestDTO::class);
            $uuid = $this->useCase->__invoke($result);

            return $this->Ok(new ResponseSuccessController(RoleMessageController::CREATED, $uuid));

        } catch (\Error $e) {

            return $this->ServerError(new ResponseErrorController($e->getMessage(), ''));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));

        }
    }

}