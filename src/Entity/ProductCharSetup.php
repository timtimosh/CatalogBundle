<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class ProductCharSetup
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="priority", type="boolean", nullable=false)
     */
    protected $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_setup", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCharSetup;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     * })
     */
    protected $idProduct;

    /**
     * @var \Mtt\CatalogBundle\Entity\Char
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Char")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_char", referencedColumnName="id_char")
     * })
     */
    protected $idChar;


}

