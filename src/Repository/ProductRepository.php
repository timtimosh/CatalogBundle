<?php

namespace CatalogBundle\Repository;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM CatalogBundle:MttCatalogProduct as p'
            )
            ->getResult();
    }

}