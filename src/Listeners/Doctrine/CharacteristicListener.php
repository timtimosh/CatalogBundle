<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Mtt\Core\Interfaces\Catalog\Entity\CharacteristicInterface;

class CharacteristicListener
{
    protected $slugger;

    use SlugifyTrait;
    use ValidationTrait;

    public function __construct(\Cocur\Slugify\SlugifyInterface $cocurSlugify)
    {
        $this->slugger = $cocurSlugify;
    }

    public function prePersist(CharacteristicInterface $entity, LifecycleEventArgs $event)
    {
        $this->validate($entity);
        $this->normalizeSlug($entity);
    }


    public function preUpdate(CharacteristicInterface $entity, PreUpdateEventArgs $event){
        $this->validate($entity);
        if ($event->hasChangedField('slug')){
            $this->normalizeSlug($entity);
        }
    }
}