<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MttCatalogProductPriceReference
 *
 * @ORM\Table(name="mtt_catalog_product_price_reference", indexes={@ORM\Index(name="idx_id_product_id_char_val_id_price_2269_17", columns={"product", "char_val", "price"}), @ORM\Index(name="IDX_81A80C2DDD7ADDD", columns={"product"})})
 * @ORM\Entity
 */
class MttCatalogProductPriceReference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_ref", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharRef;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProduct
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id_product")
     * })
     */
    private $product;

    /**
     * @var \CatalogBundle\Entity\MttCatalogCharValues
     *
     * @ORM\ManyToOne(targetEntity="MttCatalogCharValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val")
     * })
     */
    private $charVal;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProductPrice
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProductPrice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price", referencedColumnName="id_price")
     * })
     */
    private $price;


}

