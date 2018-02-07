<?php

namespace Mtt\CatalogBundle\Service;

use Doctrine\ORM\EntityManager;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter implements \Mtt\Core\Interfaces\Catalog\Service\FilterInterface
{
    protected $filteredProductsCollection;
    protected $entityManager;
    protected $request;

    public function __construct(EntityManager $entityManager, Request $request)
    {
        $this->entityManager = $entityManager;
        $this->request = $request;

    }

    public function loadProductCollectionFromRequest(){
        dump($request); exit();
    }

    protected function addCategoryToFilter($categoryId){

    }


}