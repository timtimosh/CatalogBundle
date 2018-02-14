<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Mtt\Core\Interfaces\Catalog\Entity\BasicEntityInterface;


trait SlugifyTrait
{

    protected function normalizeSlug(BasicEntityInterface $entity)
    {
        if (null === $entity->getSlug()) {
            $entity->setSlug(
                $this->slugger->slugify($entity->getName())
            );
        }
        $normalizedSlug = $this->slugger->slugify($entity->getSlug());
        $entity->setSlug($normalizedSlug);
    }
}