<?php 

namespace User;

use Psr\Container\ContainerInterface;
use Mezzio\Application;
class RoutesDelegator 
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback) : Application 
    {
        $app = $callback();
        // setup routes 
        $app->get('/api/v1/users[/]',Handler\AllUserHandler::class,'users.all');
        return $app;
    }
}