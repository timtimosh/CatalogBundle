<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MttCatalogCategoryDescription
 *
 * @ORM\Table(name="mtt_catalog_category_description")
 * @ORM\Entity
 */
class MttCatalogCategoryDescription
{
    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=255, nullable=true)
     */
    private $nameAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="description_short", type="text", length=255, nullable=true)
     */
    private $descriptionShort;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=255, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_h1", type="string", length=255, nullable=true)
     */
    private $seoH1;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keyword", type="string", length=255, nullable=true)
     */
    private $metaKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="text", length=255, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=255, nullable=true)
     */
    private $imagePath;

    /**
     * @var \CatalogBundle\Entity\MttCatalogCategory
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CatalogBundle\Entity\MttCatalogCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     * })
     */
    private $idCategory;


}

