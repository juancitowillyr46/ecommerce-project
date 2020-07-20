<?php
namespace App\Modules\Roles\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Application\UseCase\RoleEditUseCase;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleValidatorInterface;
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
    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();
            $args = (object) $this->getArgs();

            $message = $this->roleValidator->validatorParsedBody($body);
            if(count($message) > 0){
                return $this->BadRequest($message);
            }

            $result = $this->roleMapper->map($body, RoleRequestDTO::class);
            $useCase = $this->useCase->__invoke((int) $args->id, $result);

            return $this->Ok($useCase);

        } catch (\Error $err) {

            return $this->ServerError($err->getMessage());

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        }
    }

    public function validateParsedBody($body): ?Response
    {
        try {

            $userValidator = v::attribute('id', v::intVal())->
            attribute('name', v::notEmpty())->
            attribute('active', v::boolVal())->
            attribute('description', v::notEmpty());
            $userValidator->assert($body);

        }  catch(NestedValidationException $e) {

            return $this->BadRequest($e->getMessages());

        }
        return null;
    }
}