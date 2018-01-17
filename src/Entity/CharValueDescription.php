<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharValueDescription
 *
 * @ORM\Table(name="mtt_catalog_char_value_description", indexes={@ORM\Index(name="idx_id_char_val_9685_06", columns={"char_val"})})
 * @ORM\Entity
 */
class CharValueDescription
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=50, nullable=true)
     */
    private $nameAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=64, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=255, nullable=true)
     */
    private $shortDescription;

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
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=255, nullable=true)
     */
    private $imagePath;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_seo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharSeo;

    /**
     * @var \Mtt\CatalogBundle\Entity\CharValues
     *
     * @ORM\ManyToOne(targetEntity="CharValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val")
     * })
     */
    private $charVal;


}

