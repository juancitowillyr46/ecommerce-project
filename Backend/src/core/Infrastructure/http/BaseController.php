<?php
namespace App\Core\Infrastructure\Http;

use Slim\Http\ServerRequest;
use Slim\Http\Response;

abstract class BaseController
{
    protected ServerRequest $request;
    protected Response $response;
    protected array $args = [];

    abstract protected function execute(): Response;

    public function __invoke(ServerRequest $request, Response $response, array $args): Response {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        return $this->execute();
    }

    public function responseJson(): Response {
        return $this->response->withStatus(200)->withJson(array("username" => "Juan"));
    }

    public function Ok($data) {
        return $this->response->withStatus(200)->withJson($data);
    }

    public function BadRequest($message) {
        return $this->response->withStatus(400)->withJson(array("message" => $message));
    }

    public function Unauthorized($message) {
        return $this->response->withStatus(401)->withJson($message);
    }

    public function Forbidden($message) {
        return $this->response->withStatus(403)->withJson($message);
    }

    public function NotFound($message) {
        return $this->response->withStatus(404)->withJson($message);
    }

    public function ServerError($message) {
        return $this->response->withStatus(500)->withJson($message);
    }

}