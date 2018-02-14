<?php
declare(strict_types=1);

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class Category implements CategoryInterface
{
    const CATEGORY_ALIAS = 'mtt_catalog.category_entity';
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
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * One Page has One parent Page.
     * @ORM\ManyToOne(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = self::CATEGORY_ACTIVE;


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
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    protected $slug;

    /**
     * @var string
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $template;


    public function __construct()
    {
        // $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }


    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }


    public function getIdErp(): ?string
    {
        return $this->idErp;
    }

    /**
     * @param string $idErp
     */
    public function setIdErp(string $idErp)
    {
        $this->idErp = $idErp;
    }


    public function getName(): ?string
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
     * @return int
     */
    public function getParent(): ?CategoryInterface
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


    public function isActive(): bool
    {
        return $this->active ? true : false;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }


    public function getNameAlt(): ?string
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


    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }

    /**
     * @param string $descriptionShort
     */
    public function setDescriptionShort(string $descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }


    public function getDescription(): ?string
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


    public function getSeoTitle(): ?string
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


    public function getSeoH1(): ?string
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


    public function getMetaDescription(): ?string
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


    public function getMetaKeyword(): ?string
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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

