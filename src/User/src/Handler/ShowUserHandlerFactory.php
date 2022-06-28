<?php

declare(strict_types=1);

namespace User\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ShowUserHandler
    {
        return new ShowUserHandler($container->get(TemplateRendererInterface::class));
    }
}
