<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCharSetup
 *
 * @ORM\Table(name="mtt_catalog_product_char_setup", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_id_product_id_char_0301_07", columns={"id_product", "id_char"})}, indexes={@ORM\Index(name="idx_id_product_priority_0301_08", columns={"id_product", "priority"}), @ORM\Index(name="idx_id_char_0301_09", columns={"id_char"}), @ORM\Index(name="IDX_7A0AD297DD7ADDD", columns={"id_product"})})
 * @ORM\Entity
 */
class ProductCharSetup
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    private $idErp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="priority", type="boolean", nullable=false)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_setup", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharSetup;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     * })
     */
    private $idProduct;

    /**
     * @var \Mtt\CatalogBundle\Entity\Char
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Char")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_char", referencedColumnName="id_char")
     * })
     */
    private $idChar;


}

