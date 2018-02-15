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
     * @var \Vich\UploaderBundle\Templating\Helper\UploaderHelper
     */
    protected $vichUploaderHelperService;
    /**
     * Page constructor.
     * @param EntityManager $entityManager
     * @param $classEntity string
     */
    public function __construct(
        EntityManager $entityManager,
        $classEntity,
        \Symfony\Component\Routing\RouterInterface $router,
        \Vich\UploaderBundle\Templating\Helper\UploaderHelper $vichUploaderHelper
    )
    {
        $this->vichUploaderHelperService = $vichUploaderHelper;
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


    public function getProductUrl(ProductInterface $entity):string{
        return $this->router->generate('catalog_product_show', array('slug' => $entity->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * @param Product $entity
     * @return string
     */
    public function getProductMainImgPath(ProductInterface $entity):string{
        $image = null;
        if(null !== $entity->getMainImage()) {
            $image = $this->vichUploaderHelperService->asset($entity, 'mainImageFile');
        }

        if(null === $image){
            $image = 'bundles/mttcatalog/images/placeholder.jpg';
        }
        return $image;
    }
    /**
     * @param Product $entity
     * @return float
     */
    public function getPrice(ProductInterface $entity):float{
        return (float) $entity->getPrice();
    }

    public function formatPrice(float $price){
        return $price.' грн';
    }

}