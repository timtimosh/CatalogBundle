<?php

namespace CatalogBundle\Entity;

use CatalogBundle\Interfaces\BasicEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use ShopCoreBundle\Interfaces\Catalog\CharValueInterface;
use ShopCoreBundle\Interfaces\Catalog\ProductCharInterface;
use ShopCoreBundle\Interfaces\Catalog\ProductInterface;

/**
 * MttCatalogProductCharsCollection
 *
 * @ORM\Table(name="mtt_catalog_product_chars_collection", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_product_id_char_setup_id_char_val_2801_22", columns={"product", "char_val"})}, indexes={@ORM\Index(name="idx_id_img_2801_23", columns={"img"}), @ORM\Index(name="IDX_37082EDF9134D09E", columns={"product"})})
 * @ORM\Entity
 */
class MttCatalogProductCharsCollection implements ProductCharInterface, BasicEntityInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_erp", type="string", length=50, nullable=true)
     */
    private $idErp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    private $idCharSetup;


    /**
     * @var \CatalogBundle\Entity\MttCatalogCharValues
     *
     * @ORM\ManyToOne(targetEntity="MttCatalogCharValues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="char_val", referencedColumnName="id_char_val", nullable=false)
     * })
     */
    private $charValue;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProductImage
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProductImage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="img", referencedColumnName="id_img")
     * })
     */
    private $img;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProduct
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProduct", inversedBy="chars_value_collection")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id_product", nullable=false)
     * })
     */
    private $product;

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
     * @return MttCatalogProductImage
     */
    public function getImg(): MttCatalogProductImage
    {
        return $this->img;
    }

    /**
     * @param MttCatalogProductImage $img
     */
    public function setImg(MttCatalogProductImage $img)
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

