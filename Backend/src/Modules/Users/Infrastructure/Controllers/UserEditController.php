<?php
namespace App\Modules\Users\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\Users\Application\UseCase\UserEditUseCase;
use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Exceptions\UserValidatorInterface;
use App\Modules\Users\Infrastructure\UserMessagesController;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class UserEditController extends BaseController
{
    protected UserUseCaseInterface $useCase;
    protected UserMapperInterface $userMapper;
    protected LoggerInterface $logger;
    protected UserValidatorInterface $userValidator;

    public function __construct(UserEditUseCase $useCase, UserMapperInterface $userMapper, LoggerInterface $logger, UserValidatorInterface $userValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->userMapper = $userMapper;
        $this->userValidator = $userValidator;
        parent::__construct($logger);
    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();
            $args = (object) $this->getArgs();

            $message = $this->userValidator->validatorParsedBody($body);
            if(count($message) > 0){
                return $this->BadRequest(new ResponseErrorController($message, ''));
            }

            $request = $this->userMapper->getMapper()->map($body, UserRequest::class);

            $uuid = $this->useCase->__invoke($args->uuid, $request);

            return $this->Ok(new ResponseSuccessController(UserMessagesController::EDIT, $uuid));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));

        }
    }
}