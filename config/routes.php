<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->route('/signup',\User\Handler\RegisterHandler::class, ['GET','POST'],'signup');
    // $app->post('/api/v1/users', User\Handler\StoreUserHandler::class, 'users.store');
    // $app->get('/api/v1/users', User\Handler\AllUserHandler::class, 'users.all');
    //  $app->get('/api/v1/users/{id}', User\Handler\ShowUserHandler::class, 'users.show');
    //  $app->patch('/api/v1/users/{id}', User\Handler\UpdateUserHandler::class, 'users.update');
    //  $app->delete('/api/v1/users/{id}', User\Handler\DeleteUserHandler::class, 'users.delete');
    
};
# the first parametr is the route (url) 
# the second param is the middleware 
# the third param is the methods http 
#

