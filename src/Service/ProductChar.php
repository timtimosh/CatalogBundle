<?php

namespace CatalogBundle\Service;

use ShopCoreBundle\Interfaces\Catalog\ProductCharInterface;

class ProductChar extends AbstractService
{
    /**
     * @inheritdoc
     */
    public function create():ProductCharInterface
    {
        return $this->createEntity();
    }

    /**
     * @inheritdoc
     */
    public function save(ProductCharInterface $char){
        $this->saveEntity($char);
       // $this->em->persist($char->getProduct());
    }

    /**
     * @inheritdoc
     */
    public function update(ProductCharInterface $char){
        $this->updateEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function delete(ProductCharInterface $char){
        $this->deleteEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function find(int $char_id):ProductCharInterface{
        return $this->findEntity($char_id);
    }
}