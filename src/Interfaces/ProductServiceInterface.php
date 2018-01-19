<?php

namespace Mtt\CatalogBundle\Interfaces;

use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

interface ProductServiceInterface
{

    /**
     * Creates Product Entity
     * @return ProductInterface
     */
    public function create(): ProductInterface;

    /**
     * Use it to save the product
     * @param ProductInterface $product
     * @return void
     */
    public function save(ProductInterface $product);

    public function update(ProductInterface $product);

    public function delete(ProductInterface $product);

    public function find(int $product_id): ProductInterface;
}
