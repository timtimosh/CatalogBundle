<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity;

/**
 * @ORM\MappedSuperclass
 */
abstract class Product implements Entity\ProductInterface
{
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
     * @ORM\Column(name="id_product", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idProduct;

    /**
     * @ORM\OneToOne(targetEntity="Mtt\CatalogBundle\Interfaces\ProductDescriptionInterface", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $description_entity;

    /**
     * @ORM\OneToMany(targetEntity="Mtt\CatalogBundle\Interfaces\ProductCharsCollectionInterface", mappedBy="product", cascade={"remove"})
     */
    protected $chars_value_collection;

    public function __construct()
    {
        $this->chars_value_collection = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCharsCollection()
    {
        return $this->chars_value_collection;
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



    protected function getDescriptionEntity()
    {
        return $this->description_entity;
    }
    /**
     * Do not use this method dorectly it`s only purpose to solve the service
     * @return ProductDescription
     */
    public function setDescriptionEntity($descriptionEntity)
    {
        if(null!==$this->description_entity) { throw new \LogicException("Это значение стоит устанавливать только при создании новой сущности!");}
        $this->description_entity = $descriptionEntity;
    }

    public function getName()
    {
        return  $this->getDescriptionEntity()->getName();
    }

    public function setName(string $name)
    {
        $this->getDescriptionEntity()->setName($name);
    }


    public function getNameAlt(): string
    {
        return $this->getDescriptionEntity()->getNameAlt();
    }

    public function setNameAlt(string $nameAlt)
    {
        $this->getDescriptionEntity()->setNameAlt($nameAlt);
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->idProduct;
    }

}

