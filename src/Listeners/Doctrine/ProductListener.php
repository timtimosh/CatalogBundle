<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;



use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LittleHouse\CatalogBundle\Entity\Product;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class ProductListener
{
    protected $slugger;

    public function __construct(\Cocur\Slugify\SlugifyInterface $cocurSlugify)
    {
        $this->slugger = $cocurSlugify;
    }

    public function prePersist(ProductInterface $entity, LifecycleEventArgs $event)
    {
        $entity->updatedTimestamps();
        $this->normalizeSlug($entity);
        $this->productTypeCheck($entity);
    }

    /**
     * @param Product $entity
     */
    public function preUpdate(ProductInterface $entity, PreUpdateEventArgs $event){
        $entity->updatedTimestamps();
        if ($event->hasChangedField('slug')){
            $this->normalizeSlug($entity);
        }

        if($event->hasChangedField('parent') || $event->hasChangedField('type')){
            $this->productTypeCheck($entity);
        }
    }

    /**
     * @param Product $entity
     */
    protected function normalizeSlug(ProductInterface $entity)
    {
        if (null === $entity->getSlug()) {
            $entity->setSlug(
                $this->slugger->slugify($entity->getName())
            );
        }
        $normalizedSlug = $this->slugger->slugify($entity->getSlug());
        $entity->setSlug($normalizedSlug);
    }

    /**
     * @param Product $entity
     */
    protected function productTypeCheck(ProductInterface $entity){
        if($entity->getParent()){
            $entity->setType($entity::PRODUCT_TYPE_COMPLEX);
        }
        else {
            $entity->setType($entity::PRODUCT_TYPE_SIMPLE);
        }
    }
}