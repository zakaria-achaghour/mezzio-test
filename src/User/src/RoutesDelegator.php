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
        $app->post('/api/v1/users',Hanler\StoreUserHandler::class,'users.store');
        // $app->get('/api/v1/users/{id}',Hanler\ShowUserHandler::class,'users.show');
        $app->get('/api/v1/users',Handler\AllUserHandler::class,'users.all');
        // $app->put('/api/v1/users/{id}',Hanler\EditUserHandler::class,'users.edit');
        // $app->delete('/api/v1/users/{id}',Hanler\DeleteUserHandler::class,'users.delete');

        return $app;
    }
}