<?php
/**
 * Created by PhpStorm.
 * User: vladimirtimosenko
 * Date: 07.02.18
 * Time: 15:27
 */

namespace Mtt\CatalogBundle\Controller;


use Mtt\CatalogBundle\Repository\CategoryRepository;
use Mtt\CatalogBundle\Repository\ProductRepository;

trait RepositoriesTrait
{
    protected function getProductRepository():ProductRepository
    {
        return $this->getProductRepository(
            $this->getParameter('mtt_catalog.product_entity')
        );
    }

    protected function getCategoryRepository(): CategoryRepository
    {
        return $this->getProductRepository(
            $this->getParameter('mtt_catalog.category_entity')
        );
    }

    protected function getEntityRepository(string $entity):\Doctrine\ORM\EntityRepository{
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository($entity);
    }
}