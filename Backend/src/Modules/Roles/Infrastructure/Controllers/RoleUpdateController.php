<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleEditUseCase;
use App\Modules\Roles\Domain\Entities\RoleMapperInterface;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Exceptions\RoleValidatorInterface;
use App\Modules\Roles\Infrastructure\RoleMessageController;
use App\Modules\Users\Infrastructure\UserMessagesController;
use Psr\Log\LoggerInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Http\Response;

class RoleUpdateController extends BaseController
{
    protected RoleUseCaseInterface $useCase;
    protected RoleMapperInterface $roleMapper;
    protected LoggerInterface $logger;
    protected RoleValidatorInterface $roleValidator;

    public function __construct(RoleEditUseCase $useCase, RoleMapperInterface $roleMapper, LoggerInterface $logger, RoleValidatorInterface $roleValidator)
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
            $args = (object) $this->getArgs();

            $message = $this->roleValidator->validatorParsedBody($body);
            if(count($message) > 0){
                return $this->BadRequest(new ResponseErrorController($message, ''));
            }

            $request = $this->roleMapper->getMapper()->map($body, RoleRequestDTO::class);

            $uuid = $this->useCase->__invoke($args->uuid, $request);

            return $this->Ok(new ResponseSuccessController(RoleMessageController::EDIT, $uuid));

        } catch (\Error $e) {

            return $this->ServerError(new ResponseErrorController($e->getMessage(), ''));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));


        }
    }

}