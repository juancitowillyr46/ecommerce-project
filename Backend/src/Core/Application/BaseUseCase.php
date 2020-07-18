<?php
namespace App\Core\Application;

use Psr\Log\LoggerInterface;

class BaseUseCase
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

}