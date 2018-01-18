<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class ProductPriceReference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_ref", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCharRef;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id_product")
     * })
     */
    protected $product;

    /**
     * @var \Mtt\CatalogBundle\Entity\CharValue
     *
     * @ORM\ManyToOne(targetEntity="CharValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val")
     * })
     */
    protected $charVal;

    /**
     * @var \Mtt\CatalogBundle\Entity\ProductPrice
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\ProductPrice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price", referencedColumnName="id_price")
     * })
     */
    protected $price;


}

