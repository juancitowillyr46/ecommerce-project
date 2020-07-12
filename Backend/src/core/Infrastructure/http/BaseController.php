<?php
namespace App\Core\Infrastructure\Http;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

abstract class BaseController
{
    protected ServerRequest $request;
    protected Response $response;
    protected Logger $logger;
    protected array $args = [];

    public function __construct(Container $container)
    {
        try {
            $this->logger = $container->get(Logger::class);
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
        }
    }

    abstract protected function execute(): Response;

    public function __invoke(ServerRequest $request, Response $response, array $args): Response {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        return $this->execute();
    }

    public function getParsedBody(): array {
        try {
            return $this->request->getParsedBody();
        } catch (\Error $e){
            $concat = $e->getMessage() .' - '.  $e->getCode() .' - '. $e->getFile();
            $this->logger->error($concat);
            return [];
        }
    }

    public function getArgs(): array {
        try {
            return $this->args;
        } catch (\Error $e){
            $concat = $e->getMessage() .' - '.  $e->getCode() .' - '. $e->getFile();
            $this->logger->error($concat);
            return [];
        }

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

    public function ServerError($message = 'Interval server error') {
        return $this->response->withStatus(500)->withJson(array("message" => $message));
    }


}