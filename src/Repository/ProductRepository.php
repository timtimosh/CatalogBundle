<?php

namespace Mtt\CatalogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mtt\CatalogBundle\Entity\Product;
use Mtt\Core\Interfaces\Catalog\Repository\ProductRepositoryInterface;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function findAllActive($limit = 0)
    {
        $qb = $this->createProductQuery();
        $this->activeQuery($qb);

        if($limit){
            $qb->setMaxResults($limit);
        }
        return $qb;
    }

    public function findOneActiveBySlug($slug){

        $qb = $this->createProductQuery();
        $this->activeQuery($qb);

        $qb->andWhere('p.slug = :slug');
        $qb->setParameter('slug', $slug);

        $qb->setMaxResults(1);

        $result = $qb->getQuery()->getOneOrNullResult();
        return $result;
    }

    /**
     * @param $qb QueryBuilder
     */
    protected function activeQuery($qb){
        $qb->where('p.active = :active');
        // ->andWhere('f.end <= :end')
        $qb->setParameter('active', Product::ACTIVE);
    }

    protected function createProductQuery(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
            ->from($this->_entityName, 'p');
        return $qb;
    }

}