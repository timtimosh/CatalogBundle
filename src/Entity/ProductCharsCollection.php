<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mtt\Core\Interfaces\Catalog\Entity\CharValueInterface;
use Mtt\Core\Interfaces\Catalog\Entity\ProductCharInterface;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class ProductCharsCollection implements ProductCharInterface
{
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


    protected $idCharSetup;


    /**
     * @var \Mtt\CatalogBundle\Entity\CharValue
     *
     * @ORM\ManyToOne(targetEntity="CharValue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val", nullable=false)
     * })
     */
    protected $charValue;

    /**
     * @var \Mtt\CatalogBundle\Entity\ProductImage
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\ProductImage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="img", referencedColumnName="id_img")
     * })
     */
    protected $img;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product", inversedBy="chars_value_collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id_product", nullable=false)
     * })
     */
    protected $product;

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
     * @return CharValueInterface
     */
    public function getCharValue(): CharValueInterface
    {
        return $this->charValue;
    }

    public function getName():string{
        return $this->getCharValue()->getValue();
    }

    public function getValue():string{
        return $this->getCharValue()->getName();
    }

    /**
     * @param CharValueInterface $charValue
     */
    public function setCharValue(CharValueInterface $charValue)
    {
        $this->charValue = $charValue;
    }

    /**
     * @return ProductImage
     */
    public function getImg(): ProductImage
    {
        return $this->img;
    }

    /**
     * @param ProductImage $img
     */
    public function setImg(ProductImage $img)
    {
        $this->img = $img;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
        $product->getCharsCollection()->add($this);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}

