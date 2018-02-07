<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;

/**
 * @ORM\MappedSuperclass
 */

abstract class Category implements CategoryInterface
{

    const CATEGORY_ACTIVE = 1;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * One Page has One parent Page.
     * @ORM\OneToOne(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = self::PRODUCT_ACTIVE;


    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=255, nullable=true)
     */
    protected $nameAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="description_short", type="text", length=255, nullable=true)
     */
    protected $descriptionShort;

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
     *
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\ProductInterface", fetch="EXTRA_LAZY", mappedBy="categories")
     */
    protected $products;

    /**
     * @var string
     * @ORM\Column(type="text", length=255, nullable=false)
     */
    protected $slug;

    /**
     * @var string
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $template;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


    /**
     * @return string
     */
    public function getIdErp()
    {
        return $this->idErp;
    }

    /**
     * @param string $idErp
     */
    public function setIdErp($idErp)
    {
        $this->idErp = $idErp;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     */
    public function setParent(CategoryInterface $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return bool
     */
    public function isActive():bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getNameAlt()
    {
        return $this->nameAlt;
    }

    /**
     * @param string $nameAlt
     */
    public function setNameAlt($nameAlt)
    {
        $this->nameAlt = $nameAlt;
    }

    /**
     * @return string
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * @param string $descriptionShort
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @param string $seoTitle
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @return string
     */
    public function getSeoH1()
    {
        return $this->seoH1;
    }

    /**
     * @param string $seoH1
     */
    public function setSeoH1($seoH1)
    {
        $this->seoH1 = $seoH1;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products->clear();
        foreach ($products as $product){
            $this->products->add($product);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

