<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CharacteristicInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class Characteristic implements CharacteristicInterface
{
    const OPTION_VIEW_TYPE_SELECT = 0;
    const OPTION_VIEW_TYPE_RADIO = 1;

    const ACTIVE = 1;
    const UNACTIVE = 0;

    const ONSEARCH = 1;
    const NOT_ONSEARCH = 0;

    const ONINDEX = 1;
    const NOT_ONINDEX = 0;

    const ISVISIBLE = 1;
    const NOT_ISVISIBLE = 0;

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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active = self::ACTIVE;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_search", type="boolean", nullable=true)
     */
    protected $onSearch = self::ONSEARCH;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_index", type="boolean", nullable=true)
     */
    protected $onIndex = self::ONINDEX;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_visible", type="boolean", nullable=true)
     */
    protected $isVisible = self::ISVISIBLE;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="char_option_type", type="smallint")
     */
    protected $charOptionType = self::OPTION_VIEW_TYPE_SELECT;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="\Mtt\Core\Interfaces\Catalog\Entity\CharacteristicValueInterface", mappedBy="characteristic", cascade={"remove"}, fetch="EXTRA_LAZY")
     */
    protected $valuesCollection;

    public function __construct()
    {
        $this->valuesCollection = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getValuesCollection()
    {
        return $this->valuesCollection;
    }

    /**
     * @param mixed $valuesCollection
     */
    public function setValuesCollection($valuesCollection)
    {
        $this->valuesCollection = $valuesCollection;
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCharOptionType(): int
    {
        return $this->charOptionType;
    }

    /**
     * @param int $charOptionType
     */
    public function setCharOptionType(int $charOptionType)
    {
        if(!in_array($charOptionType, [self::OPTION_VIEW_TYPE_RADIO, self::OPTION_VIEW_TYPE_SELECT])){
            throw new \InvalidArgumentException("Invalid Characteristic option type");
        }
        $this->charOptionType = $charOptionType;
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
     * @return bool
     */
    public function isOnSearch(): bool
    {
        return $this->onSearch;
    }

    /**
     * @param bool $onSearch
     */
    public function setOnSearch(bool $onSearch)
    {
        $this->onSearch = $onSearch;
    }

    /**
     * @return bool
     */
    public function isOnIndex(): bool
    {
        return $this->onIndex;
    }

    /**
     * @param bool $onIndex
     */
    public function setOnIndex(bool $onIndex)
    {
        $this->onIndex = $onIndex;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    /**
     * @param bool $isVisible
     */
    public function setIsVisible(bool $isVisible)
    {
        $this->isVisible = $isVisible;
    }

    /**
     * @return MttCatalogCharOptionType
     */
    public function getOption(): int
    {
        return $this->option;
    }

    public function setOption(int $option)
    {
        $this->option = $option;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $url_key
     */
    public function setSlug(string $slug)
    {
        $this->slug= $slug;
    }


/*    public function removeCharValue($value)
    {
        $this->getCharValues()->removeElement($value);
    }

    public function attachCharValue($value)
    {
        $this->getCharValues()->add($value);
    }*/

    public function __toString(){
        return $this->getName();
    }

}

