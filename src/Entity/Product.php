<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\MappedSuperclass
 * @Vich\Uploadable
 */
abstract class Product implements Entity\ProductInterface
{
    const ALIAS = 'mtt.catalog.entity.product';
    const ONSITE = 0;
    const NOT_ONSITE = 1;

    const ACTIVE = 0;
    const NOT_ACTIVE = 1;

    const ONERP = 0;
    const NOT_ONERP = 1;
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=50, nullable=true)
     */
    protected $sku = '';

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
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $price = '0.00';

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var datetime
     *
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
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CharValueInterface", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="mtt_catalog_product_characteristic_values",
     *      joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="char_value", referencedColumnName="id")}
     *      )
     */
    protected $characteristicsValues;

    /**
     * Many Product have Many Characteristics value.
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CharInterface", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="mtt_catalog_product_characteristic",
     *      joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="characteristic", referencedColumnName="id")}
     *      )
     */
    protected $characteristics;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="tag", type="text", length=255, nullable=true)
     */
    protected $tag;


    /**
     * Many products have Many categories.
     * @ORM\ManyToMany(targetEntity="Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface", inversedBy="products", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="mtt_catalog_product_to_category",
     *      joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category", referencedColumnName="id")}
     *      )
     */
    protected $categories;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="mtt_catalog_product_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    protected $slug;


    /**
     * One Page has One parent Page.
     * @ORM\OneToOne(targetEntity="Mtt\EasyPageBundle\Entity\PageEntityInterface")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;


    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
        $this->characteristicsValues = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->image = new EmbeddedFile();
        $this->updatedAt = $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
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
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getImagesGallery()
    {
        return $this->imagesGallery;
    }

    /**
     * @param mixed $images
     */
    public function setImagesGallery($gallery)
    {
        $this->imagesGallery = $gallery;
    }

    /**
     * @return mixed
     */
    public function getCategories():Collection
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getCharacteristics():Collection
    {
        return $this->characteristics;
    }

    /**
     * @param array|ArrayCollection $characteristics
     */
    public function setCharacteristics($characteristics)
    {
        foreach ($characteristicsValues as $characteristic){
            $this->addCharacteristics($characteristic);
        }
    }

    public function addCharacteristics(Entity\CharInterface $characteristic)
    {
        if(!$this->characteristics->contains($characteristic)) {
            $this->characteristics->add($characteristic);
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
    public function setCharacteristicsValues($characteristicsValues)
    {
        foreach ($characteristicsValues as $charValue){
            $this->addCharacteristicsValues($charValue);
        }

    }

    public function addCharacteristicsValues(Entity\CharValueInterface $charValue){
        if(!$this->characteristicsValues->exists(
            function($key, $element) use ($charValue){
            return $charValue->getValue() === $element->getValue();
            }
            )) {
            $this->characteristicsValues->add($charValue);
            $this->addCharacteristics($charValue->getCharacteristic());
        }
    }

    /**
     * @return string
     */
    public function getIdErp(): string
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
    public function getSku(): string
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
        return $this->onSite;
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
        return $this->onErp;
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
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price)
    {
        $this->price = $price;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
    }

    public function __toString()
    {
        return $this->getName();
    }
}

