<?php

declare(strict_types=1);

namespace User\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use User\Entity\User;

class StoreUserHandler implements RequestHandlerInterface
{
    protected $entityManager;
    public function __construct(
        EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
       $requestBody = $request->getParsedBody();
       if(empty($requestBody)){
        $result['_error']['error'] = 'missing_request';
        $result['_error']['error_description'] = 'No request body sent.';
        return new JsonResponse($result,400);
       } 
    
       $entity = new User();
       try {
        $entity->setUser($requestBody);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
       } catch (ORMException $e) {
        $result['_error']['error'] = 'Not created';
        $result['_error']['error_description'] = $e->getMessage();
        return new JsonResponse($result,400);
       }

       return new JsonResponse($entity,201);
    }
}
