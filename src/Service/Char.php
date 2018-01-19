<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\Core\Interfaces\Catalog\Entity\CharInterface as CharEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Char extends AbstractService
{
    /**
     * @inheritdoc
     */
    public function create():CharEntityInterface
    {
        return $this->createEntity();
    }

    /**
     * @inheritdoc
     */
    public function save(CharEntityInterface $char){
        $this->saveEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function update(CharEntityInterface $char){
        $this->updateEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function delete(CharEntityInterface $char){
        $this->deleteEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function find(int $char_id):CharEntityInterface{
        return $this->findEntity($char_id);
    }

    protected function getCurrentServiceEntityName():string
    {
        return 'mtt.catalog.entity.char';
    }
}