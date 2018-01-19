<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class ProductPrice
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    protected $date;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0, nullable=true)
     */
    protected $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="price_impact", type="boolean", nullable=true)
     */
    protected $priceImpact;

    /**
     * @var boolean
     *
     * @ORM\Column(name="percentage", type="boolean", nullable=true)
     */
    protected $percentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_price", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPrice;


}

