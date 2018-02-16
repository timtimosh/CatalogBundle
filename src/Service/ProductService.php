<?php
declare(strict_types=1);

namespace Mtt\CatalogBundle\Service;


use LittleHouse\EasyPageBundle\Entity\Page;
use Mtt\CatalogBundle\Service\Product\ImagerService;
use Mtt\CatalogBundle\Service\Product\PricerService;
use Mtt\CatalogBundle\Service\Product\SeoService;
use Mtt\CatalogBundle\Service\Product\SluggerService;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class ProductService
{
    protected $classEntity;

    protected $productSluggerService;
    protected $productPricerService;
    protected $productImagerService;
    protected $productSeoService;


    public function __construct(
        string $classEntity,
        SluggerService $productSluggerService,
        PricerService $productPricerService,
        ImagerService $productImagerService,
        SeoService $productSeoService
    )
    {
        $this->classEntity = $classEntity;
        $this->productSluggerService = $productSluggerService;
        $this->productPricerService = $productPricerService;
        $this->productImagerService = $productImagerService;
        $this->productSeoService = $productSeoService;
    }

    /**
     * @return Page
     */
    public function createProduct()
    {
        return new $this->classEntity;
    }


    public function getProductUrl(ProductInterface $entity): string
    {
        return $this->productSluggerService->getProductUrl($entity);
    }


    public function getProductMainImgPath(ProductInterface $entity): string
    {
        return $this->productImagerService->getProductMainImgPath($entity);
    }


    public function getPrice(ProductInterface $entity): float
    {
        return $this->productPricerService->getPrice($entity);
    }

    public function formatPrice(float $price):string
    {
        return $this->productPricerService->formatPrice($price);
    }

}