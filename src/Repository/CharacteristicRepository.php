<?php

namespace Mtt\CatalogBundle\Repository;
use Doctrine\ORM\EntityRepository;
use \Mtt\CatalogBundle\Entity\Characteristic;

class CharacteristicRepository extends EntityRepository
{
    public function findActive()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM CatalogBundle:Characteristic c
                        WHERE c.active = '.Characteristic::ACTIVE.' 
                        AND c.onSearch = '.Characteristic::ONSEARCH.'
                        AND c.isVisible = '.Characteristic::ISVISIBLE.'
                        ORDER BY c.name
                        '
            )
            ->getResult();
    }

}