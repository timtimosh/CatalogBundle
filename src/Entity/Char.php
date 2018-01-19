<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CharInterface;
use Mtt\CatalogBundle\Interfaces\BasicEntityInterface;

abstract class Char implements CharInterface, BasicEntityInterface
{
    const OPTION_VIEW_TYPE_SELECT = 0;
    const OPTION_VIEW_TYPE_RADIO = 1;

    const ACTIVE = 0;
    const UNACTIVE = 1;

    const ONSEARCH = 0;
    const NOT_ONSEARCH = 1;

    const ONINDEX = 0;
    const NOT_ONINDEX = 1;

    const ISVISIBLE = 0;
    const NOT_ISVISIBLE = 1;

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
     * @ORM\Column(name="id_char", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idChar;

    /**
     * @var integer
     *
     * @ORM\Column(name="char_option_type", type="smallint")
     */
    protected $charOptionType = self::OPTION_VIEW_TYPE_SELECT;

    /**
     * @var string
     *
     * @ORM\Column(name="url_key", type="string", length=50, nullable=true)
     */
    protected $url_key;

    /**
     * @ORM\OneToMany(targetEntity="CharValue", mappedBy="value_collection", cascade={"persist", "remove"})
     */
    protected $value_collection;

    public function __construct()
    {
        $this->value_collection = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdChar(): int
    {
        return $this->idChar;
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
    public function getUrlKey(): string
    {
        return $this->url_key;
    }

    /**
     * @param string $url_key
     */
    public function setUrlKey(string $url_key)
    {
        $this->url_key = $url_key;
    }

    /**
     * @return ArrayCollection;
     */
    public function getCharValues():array
    {
        return $this->value_collection;
    }

/*    public function removeCharValue($value)
    {
        $this->getCharValues()->removeElement($value);
    }

    public function attachCharValue($value)
    {
        $this->getCharValues()->add($value);
    }*/

}

