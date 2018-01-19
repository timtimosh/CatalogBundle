<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\CatalogBundle\Interfaces\ProductServiceInterface;
use Mtt\Core\Interfaces\Catalog\Entity;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

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
    public function save(Entity\ProductInterface $product)
    {
        $this->saveEntity($product);
    }

    /**
     * @inheritdoc
     */
    public function update(Entity\ProductInterface $product)
    {
        $this->updateEntity($product);
    }


    /**
     * @inheritdoc
     */
    public function delete(Entity\ProductInterface $product)
    {
        $this->deleteEntity($product);
    }

    /**
     * @inheritdoc
     */
    public function find(int $product_id): Entity\ProductInterface
    {
        return $this->findEntity($product_id);
    }


}