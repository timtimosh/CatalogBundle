<?php

namespace Mtt\CatalogBundle\Service;

use Doctrine\ORM\QueryBuilder;
use Mtt\CatalogBundle\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class ProductFilterService implements \Mtt\Core\Interfaces\Catalog\Service\FilterInterface
{
    /**
     * @var  QueryBuilder
     */
    protected $filteredProductsCollection;

    protected $request;
    protected $productEntity;
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $em;

    public function __construct(RequestStack $requestStack, string $productEntity)
    {
        $this->productEntity = $productEntity;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function loadProductCollectionFromRequest(\Doctrine\Common\Persistence\ObjectManager $em){
        if(null !== $this->filteredProductsCollection){
            return $this->filteredProductsCollection;
        }
        $this->em = $em;

        $this->filteredProductsCollection = $this->getProductRepository()->findAllActive();

        $this->attachCategoryToCollection();
        return $this->filteredProductsCollection->getQuery();
    }

    protected function attachCategoryToCollection(){
        if($slug = $this->request->get('slug')){
            $this->filteredProductsCollection->innerJoin('p.categories', 'pc');
            $this->filteredProductsCollection->andWhere('pc.slug = :slug');
            $this->filteredProductsCollection->setParameter("slug", $slug);
        }
    }

    /**
     * @return ProductRepository
     */
    protected function getProductRepository():ProductRepository{
        return $this->em->getRepository($this->productEntity);
    }

}