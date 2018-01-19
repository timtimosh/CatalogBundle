<?php

namespace Mtt\CatalogBundle\Entity;

use Mtt\CatalogBundle\Interfaces\BasicEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CharValueInterface;

abstract class CharValue implements BasicEntityInterface, CharValueInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="id_char_val", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCharVal;

    /**
     * @var \Mtt\CatalogBundle\Entity\Char
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Char")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="characteristic", referencedColumnName="id_char")
     * })
     */
    protected $characteristic;

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

