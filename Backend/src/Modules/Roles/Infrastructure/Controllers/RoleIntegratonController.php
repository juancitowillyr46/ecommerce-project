<?php
namespace App\Modules\Roles\Infrastructure\Controllers;
use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleMapper;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class RoleIntegratonController extends BaseController
{
    public RoleUseCaseInterface $useCase;
    protected RoleMapperInterface $roleMapper;

    public function __construct(RoleUseCaseInterface $useCase, RoleMapperInterface $roleMapper)
    {
        $this->roleMapper = $roleMapper;
        $this->useCase = $useCase;
    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();

            $this->validateParsedBody($body);

            $result = $this->roleMapper->map($body, RoleRequestDTO::class);

            $useCase = $this->useCase->execute($result);

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