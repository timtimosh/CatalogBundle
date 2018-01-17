<?php

namespace Mtt\CatalogBundle\Service;

use CatalogBundle\Entity\MttCatalogProduct;
use CatalogBundle\Entity\MttCatalogProductDescription;
use CatalogBundle\Exceptions;
use CatalogBundle\Interfaces\ProductServiceInterface;
use ShopCoreBundle\Interfaces\Catalog;
use ShopCoreBundle\Interfaces\Catalog\ProductInterface;

class Product extends AbstractService implements ProductServiceInterface
{
    /**
     * @inheritdoc
     */
    public function create(): ProductInterface
    {
        return $this->createEntity();
    }

    /**
     * @inheritdoc
     */
    public function save(Catalog\ProductInterface $product)
    {
        $this->saveEntity($product);
    }

    /**
     * @inheritdoc
     */
    public function update(Catalog\ProductInterface $product)
    {
        $this->updateEntity($product);
    }


    /**
     * @inheritdoc
     */
    public function delete(Catalog\ProductInterface $product)
    {
        $this->deleteEntity($product);
    }

    /**
     * @inheritdoc
     */
    public function find(int $product_id): Catalog\ProductInterface
    {
        return $this->findEntity($product_id);
    }


}