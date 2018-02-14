<?php

namespace Mtt\CatalogBundle\Service;

use Doctrine\ORM\EntityManager;
use LittleHouse\EasyPageBundle\Entity\Page;
use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryService
{
    protected $em;

    protected $classEntity;
    protected $router;

    /**
     * Page constructor.
     * @param EntityManager $entityManager
     * @param $classEntity string
     */
    public function __construct(EntityManager $entityManager, $classEntity, \Symfony\Component\Routing\RouterInterface $router)
    {
        $this->em = $entityManager;
        $this->classEntity = $classEntity;
        $this->router = $router;
    }

    /**
     * @return Page
     */
    public function createCategory()
    {
        return new $this->classEntity;
    }


    public function getCategoryUrl(CategoryInterface $entity):string{
        return $this->router->generate('catalog_category_list', array('slug' => $entity->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL);
    }

}