<?php declare(strict_types=1);

namespace App\Service\RestApi\Controllers;

use App\Common\OperationResult;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;
use App\Domain\BusinessLogic\ProductLogic;
use Exception;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Psr7\Response as Psr7Response;

class ProductController {

    private $productLogic_; 

    public function __construct(ProductLogic $productLogic)
    {
        $this->productLogic_ = $productLogic;
    }

    public function Create(ServerRequest $request, Response $response): Response {

        try { 

            $requestData = (array) $request->getParsedBody();
            $logic = $this->productLogic_->Create($requestData);
            $operationResult = new OperationResult($logic, $response);
            return $operationResult->Created();

        } catch (Exception $e) {

            $operationResult = new OperationResult(null, $response);
            return $operationResult->BadRequest();
        }


    }

    public function ReadById(ServerRequest $request, Response $response, array $args = []) {
        $logic = $this->productLogic_->ReadById((int) $args['id']);
        $operationResult = new OperationResult($logic, $response);
        return $operationResult->Ok();
    }

    public function ReadAll(ServerRequest $request, Response $response) {
        $logic = $this->productLogic_->ReadAll();
        $operationResult = new OperationResult($logic, $response);
        return $operationResult->Ok();
    }

    public function Update(ServerRequest $request, Response $response, array $args = []) {
        $requestData = (array) $request->getParsedBody();
        $logic = $this->productLogic_->Update((int) $args['id'], $requestData);
        $operationResult = new OperationResult($logic, $response);
        return $operationResult->Ok();
    }

    public function Delete(ServerRequest $request, Response $response, array $args = []) {
        $logic = $this->productLogic_->Delete((int) $args['id']);
        $operationResult = new OperationResult($logic, $response);
        return $operationResult->Ok();
    }
    
}
