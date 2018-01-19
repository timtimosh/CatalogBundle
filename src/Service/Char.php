<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\Core\Interfaces\Catalog\Entity\CharInterface;

class Char extends AbstractService
{
    /**
     * @inheritdoc
     */
    public function create():CharInterface
    {
        return $this->createEntity();
    }

    /**
     * @inheritdoc
     */
    public function save(CharInterface $char){
        $this->saveEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function update(CharInterface $char){
        $this->updateEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function delete(CharInterface $char){
        $this->deleteEntity($char);
    }

    /**
     * @inheritdoc
     */
    public function find(int $char_id):CharInterface{
        return $this->findEntity($char_id);
    }
}