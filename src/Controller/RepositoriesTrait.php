<?php
namespace Mtt\CatalogBundle\Controller;

use Mtt\CatalogBundle\Entity\Category;
use Mtt\CatalogBundle\Entity\Product;
use Mtt\CatalogBundle\Repository\CategoryRepository;
use Mtt\CatalogBundle\Repository\ProductRepository;

trait RepositoriesTrait
{
    protected function getProductRepository(): ProductRepository
    {
        return $this->getEntityRepository(
            $this->getParameter(Product::PRODUCT_ALIAS)
        );
    }

    protected function getCategoryRepository(): CategoryRepository
    {
        return $this->getEntityRepository(
            $this->getParameter(Category::CATEGORY_ALIAS)
        );
    }

    protected function getEntityRepository(string $entity):\Doctrine\ORM\EntityRepository{
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository($entity);
    }
}