<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\Core\Interfaces\Catalog\Entity\ProductCharInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    protected function getCurrentServiceEntityName():string
    {
        return 'mtt.catalog.entity.product_chars_collection';
    }
}