<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\CatalogBundle\Interfaces\ProductCharToImageInterface;
use Mtt\Core\Interfaces\Catalog\Entity;

/**
 * @ORM\MappedSuperclass
 */
abstract class ProductCharToImage implements ProductCharToImageInterface
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
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Interfaces\ProductCharsCollectionInterface")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_char", referencedColumnName="id")
     * })
     */
    protected $productChar;
}

