<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\CatalogBundle\Interfaces\ProductToImageInterface;
use Mtt\Core\Interfaces\Catalog\Entity;

/**
 * @ORM\MappedSuperclass
 */
abstract class ProductToImage implements ProductToImageInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Mtt\CatalogBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\ProductInterface")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id_product")
     * })
     */
    protected $product;
}

