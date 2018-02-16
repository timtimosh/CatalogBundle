<?php
namespace Mtt\CatalogBundle\Service\Product;

use Doctrine\ORM\EntityManagerInterface;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class SeoService
{
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

}