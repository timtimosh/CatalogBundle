<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MttCatalogCategoryToProduct
 *
 * @ORM\Table(name="mtt_catalog_category_to_product", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_id_product_id_category_8507_01", columns={"id_product", "id_category"})}, indexes={@ORM\Index(name="idx_id_category_8507_02", columns={"id_category"}), @ORM\Index(name="IDX_3EBDE850DD7ADDD", columns={"id_product"})})
 * @ORM\Entity
 */
class MttCatalogCategoryToProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CatalogBundle\Entity\MttCatalogCategory
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     * })
     */
    private $idCategory;

    /**
     * @var \CatalogBundle\Entity\MttCatalogProduct
     *
     * @ORM\ManyToOne(targetEntity="CatalogBundle\Entity\MttCatalogProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     * })
     */
    private $idProduct;


}

