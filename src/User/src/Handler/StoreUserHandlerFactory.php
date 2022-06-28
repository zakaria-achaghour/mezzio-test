<?php

declare(strict_types=1);

namespace User\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class StoreUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : StoreUserHandler
    {
        return new StoreUserHandler($container->get(EntityManager::class));
    }
}
