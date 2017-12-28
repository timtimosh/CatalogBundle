<?php

namespace CatalogBundle\Service;

use CatalogBundle\Exceptions\FailedToSaveProductException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use CatalogBundle\Interfaces\BasicEntityInterface;

abstract class AbstractService
{
    protected $em;
    protected $entity;

    public function __construct(EntityManagerInterface $em, string $entity_name)
    {
        $this->em = $em;
        $this->entity = $entity_name;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->em->getRepository($this->entity);
    }


    private function isNewRecord(BasicEntityInterface $entity): bool
    {
        return $this->em->contains($entity) ? false : true;
    }

    protected function checkUpdateAllowed(BasicEntityInterface $entity)
    {
        if ($this->isNewRecord($entity)) {
            throw new FailedToSaveProductException('Product Entity is not exist yet, try to use create method instead');
        }
    }

    protected function checkSaveAllowed(BasicEntityInterface $entity)
    {
        if (!$this->isNewRecord($entity)) {
            throw new FailedToSaveProductException('Product Entity is already exists, try to use update method instead');
        }
    }

    protected function createEntity(): BasicEntityInterface
    {
        $entity = new $this->entity();
        return $entity;
    }

    protected function saveEntity(BasicEntityInterface $entity)
    {
        $this->checkSaveAllowed($entity);
        $this->em->persist($entity);
        $this->em->flush();
    }

    protected function updateEntity(BasicEntityInterface $entity)
    {
        $this->checkUpdateAllowed($entity);
        $this->em->flush();
    }

    protected function deleteEntity(BasicEntityInterface $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    protected function findEntity(int $id):BasicEntityInterface
    {
        return $this->getRepository()->find($id);
    }
}
