<?php

namespace Mtt\CatalogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mtt\CatalogBundle\Entity\Category;

class CategoryRepository extends EntityRepository
{
    public function findAllActive($limit = 0)
    {
        $qb = $this->createCategoryQuery();
        $this->activeQuery($qb);

        if($limit){
            $qb->setMaxResults($limit);
        }

        return $qb;
    }

    public function findOneActiveBySlug($slug){

        $qb = $this->createCategoryQuery();
        $this->activeQuery($qb);

        $qb->andWhere('c.slug = :slug');
        $qb->setParameter('slug', $slug);

        $qb->setMaxResults(1);

        $result = $qb->getQuery()->getOneOrNullResult();
        return $result;
    }

    /**
     * @param $qb QueryBuilder
     */
    public function activeQuery($qb){
        $qb->where('c.active = :active');
        // ->andWhere('f.end <= :end')
        $qb->setParameter('active', Category::CATEGORY_ACTIVE);
    }

    public function createCategoryQuery(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->_entityName, 'c');
        return $qb;
    }

}