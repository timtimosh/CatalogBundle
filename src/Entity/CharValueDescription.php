<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class CharValueDescription
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=50, nullable=true)
     */
    protected $nameAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=64, nullable=true)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=255, nullable=true)
     */
    protected $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=255, nullable=true)
     */
    protected $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_h1", type="string", length=255, nullable=true)
     */
    protected $seoH1;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255, nullable=true)
     */
    protected $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keyword", type="string", length=255, nullable=true)
     */
    protected $metaKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    protected $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=255, nullable=true)
     */
    protected $imagePath;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_seo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCharSeo;

    /**
     * @var \Mtt\CatalogBundle\Entity\CharValue
     *
     * @ORM\ManyToOne(targetEntity="CharValue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val")
     * })
     */
    protected $charVal;


}

