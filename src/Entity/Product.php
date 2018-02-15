<?php
declare(strict_types=1);
namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\MappedSuperclass
 * @Vich\Uploadable
 */
abstract class Product implements Entity\ProductInterface
{
    const PRODUCT_ALIAS = 'mtt_catalog.product_entity';
    const ONSITE = 1;
    const NOT_ONSITE = 0;

    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const ONERP = 1;
    const NOT_ONERP = 0;


    const PRODUCT_TYPE_SIMPLE = 'simple';
    const PRODUCT_TYPE_COMPLEX = 'complex';
    const PRODUCT_TYPE_WITH_VARIANTS = 'variant';


    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=50, nullable=true)
     */
    protected $sku;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_site", type="boolean", nullable=true)
     */
    protected $onSite = self::ONSITE;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_erp", type="boolean", nullable=true)
     */
    protected $onErp = self::ONERP;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active = self::ACTIVE;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var float
     * @Assert\Type(type="float", message="The value {{ value }} is not a valid {{ type }}.")
     * @ORM\Column(name="price", type="float", scale=2, nullable=true)
     */
    protected $price = 0.00;

    /**
     * @var datetime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var datetime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Many Product have Many Characteristics value.
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CharacteristicValueInterface", fetch="EXTRA_LAZY", cascade={"persist"})
     * @ORM\JoinTable(name="mtt_catalog_product_characteristic_values",
     *      joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="char_value", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    protected $characteristicsValues;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_alt", type="string", length=255, nullable=true)
     */
    protected $nameAlt;

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
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=255, nullable=true)
     */
    protected $shortDescription;

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
     * Many products have Many categories.
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface", fetch="EXTRA_LAZY", cascade={"persist"})
     * @ORM\JoinTable(name="mtt_catalog_product_to_category",
     *      joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    protected $categories;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $mainImage;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="mtt_catalog_product_image", fileNameProperty="mainImage")
     * @var File
     */
    protected $mainImageFile;


    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    protected $slug;


    /**
     * One Page has One parent Page.
     * @ORM\ManyToOne(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\ProductInterface")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=20, nullable=false)
    */
    protected $type;


    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity = 0;

    public function __construct()
    {
        $this->characteristicsValues = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getQuantity():int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }


    /**
     * @return mixed
     */
    public function getType():?string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(string $type)
    {
        if (!in_array(
            $type, [self::PRODUCT_TYPE_COMPLEX, self::PRODUCT_TYPE_SIMPLE, self::PRODUCT_TYPE_WITH_VARIANTS])
        ) {
            throw new \InvalidArgumentException("Invalid product type");
        }
        $this->type = $type;
    }


    /**
     * @return string
     */
    public function getSlug():?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getParent(): ?Entity\ProductInterface
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent(Entity\ProductInterface $parent)
    {
        $this->parent = $parent;
    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     */
    public function setMainImageFile(?File $image = null)
    {
        $this->mainImageFile = $image;
        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedTimestamps();
        }
    }

    public function getMainImageFile():?File
    {
        return $this->mainImageFile;
    }

    public function setMainImage($image)
    {
        $this->mainImage = $image;
    }

    public function getMainImage(): ?string
    {
        return $this->mainImage;
    }


    /**
     * @return mixed
     */
    public function getCategories():Collection
    {
        return $this->categories;
    }

    public function setCategories(array $categories)
    {
        foreach ($categories as $category){
            $this->addCategory($category);
        }

    }

    public function addCategory(Entity\CategoryInterface $category){
        if (!$this->getCategories()->contains($category)) {
            $this->categories->add($category);
        }
    }

    public function removeCategory(Entity\CategoryInterface $category){
        if ($this->getCategories()->contains($category)) {
            $this->getCategories()->removeElement($category);
        }
    }

    /**
     * @return mixed
     */
    public function getCharacteristicsValues():Collection
    {
        return $this->characteristicsValues;
    }

    /**
     * @param array|Collection $characteristics
     */
    public function setCharacteristicsValues(array $characteristicsValues)
    {
        foreach ($characteristicsValues as $charValue){
            $this->addCharacteristicsValues($charValue);
        }

    }

    public function addCharacteristicsValues(Entity\CharacteristicValueInterface $charValue){
        if (!$this->getCharacteristicsValues()->contains($charValue)) {
            $this->characteristicsValues->add($charValue);
        }
    }

    public function removeCharacteristicsValues(Entity\CharacteristicValueInterface $charValue){
        if ($this->getCharacteristicsValues()->contains($charValue)) {
            $this->getCharacteristicsValues()->removeElement($charValue);
        }
    }

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return bool
     */
    public function isOnSite(): bool
    {
        return $this->onSite ? true: false;
    }

    /**
     * @param bool $onSite
     */
    public function setOnSite(bool $onSite)
    {
        $this->onSite = $onSite;
    }

    /**
     * @return bool
     */
    public function isOnErp(): bool
    {
        return $this->onErp ? true: false;
    }

    /**
     * @param bool $onErp
     */
    public function setOnErp(bool $onErp)
    {
        $this->onErp = $onErp;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active ? true: false;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     */
    public function setSortOrder(int $sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return string
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }


    public function updatedTimestamps()
    {
        $this->updatedAt = new \DateTime('now');
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
    }


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt():?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt():?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
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
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }



    /**
     * @return string
     */
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

    /**
     * @return string
     */
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


    public function __toString()
    {
        return $this->getName();
    }
}

