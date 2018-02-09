<?php

namespace Mtt\CatalogBundle\Service;

use Doctrine\ORM\EntityManager;
use LittleHouse\EasyPageBundle\Entity\Page;
use Mtt\CatalogBundle\Entity\Product;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductService
{
    protected $em;

    protected $classEntity;
    protected $router;

    /**
     * Page constructor.
     * @param EntityManager $entityManager
     * @param $classEntity string
     */
    public function __construct(EntityManager $entityManager, $classEntity, \Symfony\Component\Routing\RouterInterface $router)
    {
        $this->em = $entityManager;
        $this->classEntity = $classEntity;
        $this->router = $router;
    }

    /**
     * @return Page
     */
    public function createProduct()
    {
        return new $this->classEntity;
    }


    public function getProductUrl(Product $entity):string{
        return $this->router->generate('catalog_product_show', array('slug' => $entity->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL);
    }

}