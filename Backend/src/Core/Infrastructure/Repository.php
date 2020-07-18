<?php
namespace App\Core\Infrastructure;

use App\Core\Application\BaseRequest;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

abstract class Repository
{
    private Object $class;
    private Container $container;

    public function __construct(Object $class, Container $container)
    {
        $this->class = $class;

        try {
            $this->container->get($this->class);
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
        }

    }

    public function create(BaseRequest $request): Object
    {
       return $this->class;
    }
}