<?php
declare(strict_types=1);

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CharacteristicInterface;
use Mtt\Core\Interfaces\Catalog\Entity\CharacteristicValueInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class CharacteristicValue implements CharacteristicValueInterface
{
    const CHARACTERISTIC_VALUES_ALIAS = 'mtt_catalog.characteristic_value_entity';
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="value", type="string", length=50, nullable=false)
     */
    protected $value;

    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    protected $idErp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Mtt\CatalogBundle\Entity\Characteristic
     *
     * @ORM\ManyToOne(targetEntity="\Mtt\Core\Interfaces\Catalog\Entity\CharacteristicInterface", inversedBy="valuesCollection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="characteristic", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    protected $characteristic;


    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="slug", type="string", length=64, nullable=false)
     */
    protected $slug;

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
     * @return string
     */
    public function getSlug(): ?string
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


    public function getShortDescription(): ?string
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


    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
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


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCharacteristic(): ?CharacteristicInterface
    {
        return $this->characteristic;
    }

    /**
     * @param Characteristic $char
     */
    public function setCharacteristic(CharacteristicInterface $char)
    {
        $this->characteristic = $char;
    }

    public function getName(): string
    {
        return $this->getCharacteristic()->getName();
    }

    public function __toString()
    {
        return $this->getName() . ': ' . $this->getValue();
    }
}

