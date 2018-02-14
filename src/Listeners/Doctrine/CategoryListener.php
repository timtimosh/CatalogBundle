<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;

class CategoryListener
{
    protected $slugger;

    use SlugifyTrait;

    public function __construct(\Cocur\Slugify\SlugifyInterface $cocurSlugify)
    {
        $this->slugger = $cocurSlugify;
    }

    public function prePersist(CategoryInterface $entity, LifecycleEventArgs $event)
    {
        $this->normalizeSlug($entity);
    }


    public function preUpdate(CategoryInterface $entity, PreUpdateEventArgs $event){
        if ($event->hasChangedField('slug')){
            $this->normalizeSlug($entity);
        }
    }
}