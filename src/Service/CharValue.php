<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\Core\Interfaces\Catalog\Entity\CharValueInterface;

class CharValue extends AbstractService
{
    /**
     * @inheritdoc
     * @return \Mtt\CatalogBundle\Entity\CharValue;
     */
    public function create():CharValueInterface
    {
        return $this->createEntity();
    }

    /**
     * @inheritdoc
     */
    public function save(CharValueInterface $charValue)
    {
        $this->saveEntity($charValue);
    }

    /**
     * @inheritdoc
     */
    public function update(CharValueInterface $charValue)
    {
        $this->updateEntity($charValue);
    }

    /**
     * @inheritdoc
     */
    public function delete(CharValueInterface $charValue)
    {
        $this->deleteEntity($charValue);
    }

    /**
     * @inheritdoc
     */
    public function find(int $char_value_id):CharValueInterface
    {
        return $this->findEntity($char_value_id);
    }
}