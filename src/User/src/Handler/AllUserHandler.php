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
use Mezzio\Helper\UrlHelper;

class AllUserHandler implements RequestHandlerInterface
{
    protected $entityManager;
    protected $pageCount;
    protected $urlHelper;
    public function __construct(
        EntityManager $entityManager,
            $pageCount,UrlHelper $urlHelper)
    {
        $this->entityManager = $entityManager;
        $this->pageCount = $pageCount;
        $this->urlHelper = $urlHelper;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $q = $this->entityManager->getRepository('User\Entity\User')
            ->createQueryBuilder('c')
            ->getQuery();
            $paginator = new Paginator($q);
            $totalItems = count($paginator);
            $currentPage = ($request->getAttribute('page')) ? : 1;
            $totalPageCount = ceil($totalItems / $this->pageCount);
            $nextPage = (($currentPage < $totalPageCount) ? $currentPage +1 : $totalPageCount );
            $previousPage = (($currentPage < 1) ? $currentPage - 1 : 1 );



            $records = $paginator->getQuery()
                        ->setFirstResult($this->pageCount * ($currentPage-1))
                        ->setMaxResults($this->pageCount )
                        ->getResult(Query::HYDRATE_ARRAY);
        // $result['_embedded'] = [1 => 'test1', 2 => 'test2'];
        // Render and return a response:

        // $result['_per_page'] = $this->pageCount;
        // $result['_page'] = $currentPage;
        // $result['_total'] = $totalItems;
        // $result['_total_pages'] = $totalPageCount;
        // $result['_links']['self'] = $this->urlHelper->generate('users.all',['page'=>$currentPage]);
        // $result['_links']['first'] = $this->urlHelper->generate('users.all',['page'=>1]);
        // $result['_links']['previous'] = $this->urlHelper->generate('users.all',['page'=>$previousPage]);
        // $result['_links']['next'] =$this->urlHelper->generate('users.all',['page'=>$nextPage]);
        // $result['_links']['last'] =$this->urlHelper->generate('users.all',['page'=>$totalPageCount]);




        $result['_embedded']['users'] = $records;
        return new JsonResponse($result);
    }
}
