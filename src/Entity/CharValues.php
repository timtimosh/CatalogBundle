<?php

namespace Mtt\CatalogBundle\Entity;

use CatalogBundle\Interfaces\BasicEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use ShopCoreBundle\Interfaces\Catalog\CharValueInterface;

/**
 * CharValues
 *
 * @ORM\Table(name="mtt_catalog_char_values", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_id_char_value_0629_10", columns={"characteristic", "value"})}, indexes={@ORM\Index(name="IDX_724A6D297DE4B9D", columns={"characteristic"})})
 * @ORM\Entity
 */
class CharValues implements BasicEntityInterface, CharValueInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    private $idErp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_char_val", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCharVal;

    /**
     * @var \Mtt\CatalogBundle\Entity\Char
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Char")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="characteristic", referencedColumnName="id_char")
     * })
     */
    private $characteristic;

    /**
     * @return string
     */
    public function getValue(): string
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
     * @return int
     */
    public function getIdCharVal(): int
    {
        return $this->idCharVal;
    }

    /**
     * @return Char
     */
    protected function getChar(): Char
    {
        return $this->characteristic;
    }

    /**
     * @param Char $char
     */
    public function setChar(Char $char)
    {
        $this->characteristic = $char;
    }

    public function getName(): string
    {
        return $this->getChar()->getName();
    }
}

