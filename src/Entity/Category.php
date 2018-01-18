<?php

namespace Mtt\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class Category
{
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
     * @var integer
     *
     * @ORM\Column(name="parent", type="integer", nullable=false)
     */
    protected $parent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected $active = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_category", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idCategory;


}

