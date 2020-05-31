<?php declare(strict_types=1);

namespace App\Service\RestApi\Controllers;

use App\Domain\BusinessEntity\DtoRequest\ProductDto;
use App\Domain\BusinessLogic\CategoryLogic;
use App\Domain\BusinessLogic\ProductLogic;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

class CategoryController {

    private $categoryLogic_; 

    public function __construct(CategoryLogic $categoryLogic)
    {
        $this->categoryLogic_ = $categoryLogic;
    }

    public function Create(ServerRequest $request, Response $response) {

        $requestData = (array) $request->getParsedBody();
        $operationResut = $this->categoryLogic_->Create($requestData);
        return $response->withJson(['message' => 'POST', 'data' => $operationResut]);

    }

    public function ReadById(ServerRequest $request, Response $response) {
        return $response->withJson(['message' => 'GET']);
    }

    public function ReadAll(ServerRequest $request, Response $response) {
        $operationResut = $this->categoryLogic_->ReadAll();
        return $response->withJson(['message' => 'GET', 'data' => $operationResut]);
    }

    public function Update(ServerRequest $request, Response $response) {
        return $response->withJson(['message' => 'PUT']);
    }

    public function Delete(ServerRequest $request, Response $response) {
        return $response->withJson(['message' => 'DELETE']);
    }
    
}
