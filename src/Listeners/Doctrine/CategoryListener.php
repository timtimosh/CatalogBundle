<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Mtt\CatalogBundle\Entity\Product;
use Mtt\CatalogBundle\Exceptions\EntityRemoveException;
use Mtt\CatalogBundle\Repository\CategoryRepository;
use Mtt\CatalogBundle\Repository\ProductRepository;
use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;

class CategoryListener
{
    protected $slugger;
    protected $categoryRepository;
    protected $productRepository;

    use SlugifyTrait;

    public function __construct(
        \Cocur\Slugify\SlugifyInterface $cocurSlugify,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository)
    {
        $this->slugger = $cocurSlugify;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function prePersist(CategoryInterface $entity, LifecycleEventArgs $event)
    {
        $entity->updatedTimestamps();
        $this->normalizeSlug($entity);
    }


    public function preUpdate(CategoryInterface $entity, PreUpdateEventArgs $event){
        $entity->updatedTimestamps();
        if ($event->hasChangedField('slug')){
            $this->normalizeSlug($entity);
        }
    }

    public function preRemove(CategoryInterface $entity, LifecycleEventArgs $event){
        if($this->categoryRepository->findOneByParent($entity->getId())) {
            throw new EntityRemoveException("Can`t remove this category, it contains another categories!");
        }


    }
}