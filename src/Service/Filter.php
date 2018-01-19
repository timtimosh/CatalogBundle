<?php

namespace Mtt\CatalogBundle\Service;

use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class Filter implements \Mtt\Core\Interfaces\Catalog\Service\FilterInterface
{
    protected $filteredProductsCollection = [];

    public function __construct(ProductInterface $productService)
    {
        $this->filteredProductsCollection = new \SplObjectStorage();
    }

    /**
     * @var string
     */
    protected $sort;
    /**
     * @var integer
     */
    protected $limit;
    /**
     * @var integer
     */
    protected $offset;
    /**
     * @var string
     */
    protected $order;

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }


}