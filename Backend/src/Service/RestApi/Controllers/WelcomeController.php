<?php declare(strict_types=1);

namespace App\Service\RestApi\Controllers;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class WelcomeController
{
    public function Index(ServerRequest $request, Response $response): Response {
        return $response->withJson(['message' => 'Welcome REST Commerce Project']);
    }

}