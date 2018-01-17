<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryToProduct
 *
 * @ORM\Table(name="mtt_catalog_category_to_product", uniqueConstraints={@ORM\UniqueConstraint(name="idx_UNIQUE_id_product_id_category_8507_01", columns={"id_product", "id_category"})}, indexes={@ORM\Index(name="idx_id_category_8507_02", columns={"id_category"}), @ORM\Index(name="IDX_3EBDE850DD7ADDD", columns={"id_product"})})
 * @ORM\Entity
 */
class CategoryToProduct
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
     * @var \Mtt\CatalogBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     * })
     */
    private $idCategory;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     * })
     */
    private $idProduct;


}

