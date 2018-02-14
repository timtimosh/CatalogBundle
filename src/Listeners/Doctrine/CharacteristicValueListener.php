<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Mtt\Core\Interfaces\Catalog\Entity\CharacteristicValueInterface;

class CharacteristicValueListener
{
    protected $slugger;

    use SlugifyTrait;

    public function __construct(\Cocur\Slugify\SlugifyInterface $cocurSlugify)
    {
        $this->slugger = $cocurSlugify;
    }

    public function prePersist(CharacteristicValueInterface $entity, LifecycleEventArgs $event)
    {
        $this->normalizeSlug($entity);
    }

    /**
     * @param Product $entity
     */
    public function preUpdate(CharacteristicValueInterface $entity, PreUpdateEventArgs $event){
        if ($event->hasChangedField('slug')){
            $this->normalizeSlug($entity);
        }
    }
}