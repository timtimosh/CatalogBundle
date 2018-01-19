<?php

namespace Mtt\CatalogBundle\Service;

use LittleHouse\CatalogBundle\Entity\ProductDescription;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;
use Mtt\Core\Interfaces\Catalog\Entity;
use Mtt\Core\Interfaces\Catalog\Service\ProductInterface as ProductService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Product extends AbstractService implements ProductService
{
    /**
     * @inheritdoc
     */
    public function create(): ProductInterface
    {
        /**
         * @var $entity \Mtt\CatalogBundle\Entity\Product
         */
        $entity = parent::createEntity();
        $descriptionEntity = $this->getDescriptionEntity();
        $entity->setDescriptionEntity($descriptionEntity);
    }

    protected function getDescriptionEntity(){
        return new ProductDescription();
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

    protected function getCurrentServiceEntityName():string
    {
        return 'mtt.catalog.entity.product';
    }
}