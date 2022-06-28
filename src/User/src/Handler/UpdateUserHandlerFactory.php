<?php

declare(strict_types=1);

namespace User\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class UpdateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : UpdateUserHandler
    {
        return new UpdateUserHandler($container->get(TemplateRendererInterface::class));
    }
}
