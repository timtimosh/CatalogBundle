<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MttCatalogProductDescription
 *
 * @ORM\Table(name="mtt_catalog_product_description", indexes={@ORM\Index(name="idx_main_image_0982_11", columns={"main_image"})})
 * @ORM\Entity
 */
class MttCatalogProductDescription
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=255, nullable=true)
     */
    private $nameAlt;

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
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=255, nullable=true)
     */
    private $shortDescription;

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
     * @var \CatalogBundle\Entity\MttCatalogProduct
     *
     * @ORM\OneToOne(targetEntity="CatalogBundle\Entity\MttCatalogProduct", inversedBy="description_entity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="product", referencedColumnName="id_product")
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProductImage
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProductImage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="main_image", referencedColumnName="id_img", nullable=true)
     * })
     */
    private $mainImage;

    /**
     * @return MttCatalogProduct
     */
    public function getProduct(): MttCatalogProduct
    {
        return $this->product;
    }

    /**
     * @param MttCatalogProduct $product
     */
    public function setProduct(MttCatalogProduct $product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameAlt(): string
    {
        return $this->nameAlt;
    }

    /**
     * @param string $nameAlt
     */
    public function setNameAlt(string $nameAlt)
    {
        $this->nameAlt = $nameAlt;
    }

    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->seoTitle;
    }

    /**
     * @param string $seoTitle
     */
    public function setSeoTitle(string $seoTitle)
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @return string
     */
    public function getSeoH1(): string
    {
        return $this->seoH1;
    }

    /**
     * @param string $seoH1
     */
    public function setSeoH1(string $seoH1)
    {
        $this->seoH1 = $seoH1;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription(string $metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getMetaKeyword(): string
    {
        return $this->metaKeyword;
    }

    /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword(string $metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return MttCatalogProductImage
     */
    public function getMainImage(): MttCatalogProductImage
    {
        return $this->mainImage;
    }

    /**
     * @param MttCatalogProductImage $mainImage
     */
    public function setMainImage(MttCatalogProductImage $mainImage)
    {
        $this->mainImage = $mainImage;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }


}

