<?php

namespace Mtt\CatalogBundle\Service;

use Doctrine\ORM\EntityManager;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class ProductFilter implements \Mtt\Core\Interfaces\Catalog\Service\FilterInterface
{
    protected $filteredProductsCollection;
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addCategoryToFilter($categoryId){

    }


}