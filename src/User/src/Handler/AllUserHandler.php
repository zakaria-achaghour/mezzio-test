<?php

declare(strict_types=1);

namespace User\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class AllUserHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;
    public function __construct(EntityManager $entityManager,$pageCount)
    {
        $this->entityManager = $entityManager;
        $this->pageCount = $pageCount;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $q = $this->entityManager->getRepository('User\Entity\User')
            ->createQueryBuilder('c')
            ->getQuery();
            $paginator = new Paginator($q);
            $totalItems = count($paginator);
            $currentPage = ($request->getAttribute('page')) ? : 1;
            $totalPageCount = ceil($totalItems/$this->pageCount);

            $records = $paginator->getQuery();
                        ->getResult(Query::HYDRATE_ARRAY);
        // $result['_embedded'] = [1 => 'test1', 2 => 'test2'];
        // Render and return a response:
        return new JsonResponse($records);
    }
}
