<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPrice
 *
 * @ORM\Table(name="mtt_catalog_product_price", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_id_price_1969_15", columns={"id_price"}), @ORM\UniqueConstraint(name="idx_UNIQUE_id_price_date_1969_16", columns={"id_price", "date"})})
 * @ORM\Entity
 */
class ProductPrice
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    private $idErp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="price_impact", type="boolean", nullable=true)
     */
    private $priceImpact;

    /**
     * @var boolean
     *
     * @ORM\Column(name="percentage", type="boolean", nullable=true)
     */
    private $percentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_price", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrice;


}

