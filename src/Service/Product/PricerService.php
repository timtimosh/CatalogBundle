<?php

namespace Mtt\CatalogBundle\Service\Product;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class PricerService
{
    public function __construct()
    {
    }

    public function getPrice(ProductInterface $entity):float{
        return (float) $entity->getPrice();
    }

    public function formatPrice(float $price){
        return $price.' грн';
    }
}