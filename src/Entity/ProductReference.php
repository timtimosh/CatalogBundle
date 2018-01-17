<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductReference
 *
 * @ORM\Table(name="mtt_catalog_product_reference", indexes={@ORM\Index(name="idx_id_ancestor_2561_20", columns={"id_ancestor"}), @ORM\Index(name="idx_id_descendant_2562_21", columns={"id_descendant"})})
 * @ORM\Entity
 */
class ProductReference
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
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_descendant", referencedColumnName="id_product")
     * })
     */
    private $idDescendant;

    /**
     * @var \Mtt\CatalogBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Mtt\CatalogBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ancestor", referencedColumnName="id_product")
     * })
     */
    private $idAncestor;


}

