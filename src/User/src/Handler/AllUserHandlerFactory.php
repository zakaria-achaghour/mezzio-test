<?php

declare(strict_types=1);

namespace User\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class AllUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AllUserHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $urlhelper = $container->get(UrlHelper::class);
        return new AllUserHandler($entityManager,
        $container->get('config')['page_size']
        ,$urlhelper);
    }
}
