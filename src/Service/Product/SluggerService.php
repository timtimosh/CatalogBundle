<?php
namespace Mtt\CatalogBundle\Service\Product;

use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SluggerService
{
    protected $router;

    public function __construct(\Symfony\Component\Routing\RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getProductUrl(ProductInterface $entity):string{
        return $this->router->generate('catalog_product_show', array('slug' => $entity->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL);
    }
}