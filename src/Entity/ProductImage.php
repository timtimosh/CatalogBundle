<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductImage
 *
 * @ORM\Table(name="mtt_catalog_product_image", indexes={@ORM\Index(name="idx_id_product_1329_12", columns={"id_product"}), @ORM\Index(name="idx_id_spacification_1329_13", columns={"id_specification"})})
 * @ORM\Entity
 */
class ProductImage
{
    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="file_dir", type="string", length=255, nullable=false)
     */
    private $fileDir;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesize", type="integer", nullable=false)
     */
    private $filesize;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=false)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt", type="string", length=255, nullable=false)
     */
    private $imageAlt;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=false)
     */
    private $sortOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_img", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idImg;

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
     * @var \Mtt\CatalogBundle\Entity\ProductCharsCollection
     *
     * @ORM\ManyToOne(targetEntity="ProductCharsCollection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_specification", referencedColumnName="id")
     * })
     */
    private $idSpecification;


}

