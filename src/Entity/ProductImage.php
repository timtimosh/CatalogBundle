<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class ProductImage
{
    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=false)
     */
    protected $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="file_dir", type="string", length=255, nullable=false)
     */
    protected $fileDir;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesize", type="integer", nullable=false)
     */
    protected $filesize;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=false)
     */
    protected $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt", type="string", length=255, nullable=false)
     */
    protected $imageAlt;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=false)
     */
    protected $sortOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_img", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idImg;

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
     * @var \Mtt\CatalogBundle\Entity\ProductCharsCollection
     *
     * @ORM\ManyToOne(targetEntity="ProductCharsCollection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_specification", referencedColumnName="id")
     * })
     */
    protected $idSpecification;


}

