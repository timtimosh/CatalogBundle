<?php

namespace Mtt\CatalogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mtt\CatalogBundle\Entity\Product;

class ProductRepository extends EntityRepository
{
    public function findAllActive()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ' . $this->_entityName . ' as p
                WHERE p.active = ' . Product::ACTIVE . ' '
            );
    }

}