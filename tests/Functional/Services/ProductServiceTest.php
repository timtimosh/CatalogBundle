<?php

namespace Mtt\CatalogBundle\Tests\Functional\Services;


use Doctrine\Common\Collections\ArrayCollection;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;
use Mtt\CatalogBundle\Service\AbstractService;
use Mtt\CatalogBundle\Tests\Functional\Services\AbstractTest;

class ProductServiceTest extends AbstractTest
{
    protected $mockName = 'productsMocks';

    public function testProductCreation()
    {
        $product_service = $this::$container->get('test_alias.catalog.product.service');
        $product = $product_service->create();

        $this->assertTrue($product instanceof ProductInterface);
    }

    public function testProductSave()
    {
        $product_service = $this::$container->get('test_alias.catalog.product.service');

        foreach ($this->getMock() as $productFromMock) {
            $product = $product_service->create();
            $product->setSku($productFromMock['sku']);
            $product->setIdErp($productFromMock['idErp']);
            $product->setName($productFromMock['name']);
            $this->assertNull($product_service->save($product));
        }
    }


    public function testFindProduct()
    {
        $product_service = $this::$container->get('test_alias.catalog.product.service');
        foreach ($this->getMock() as $productFromMock) {
            $product = $product_service->getRepository()->findOneBySku($productFromMock['sku']);
            $this->assertTrue($product instanceof ProductInterface);
            $this->assertEquals(
                $product->getName(),
                $productFromMock['name']
            );
        }
    }


    public function testProductUpdate()
    {
        $product_service = $this::$container->get('test_alias.catalog.product.service');
        $mockProduct = $this->getMock()->first();
        $product = $product_service->getRepository()->findOneBySku($mockProduct['sku']);
        //dump($product);
        $newName = 'Any new Name Кириллица /221';
        $product->setName($newName);
        $product->setSortOrder(26);
        $product_service->update($product);

        $changedProduct = $product_service->getRepository()->find($product->getProductId());
        //dump($changedProduct->getName());
        $this->assertEquals(
            $changedProduct->getName(),
            $newName
        );
        $this->expectException('CatalogBundle\Exceptions\FailedToSaveProductException');
        $product_service->save($product);
    }


    public function testProductDelete()
    {
        $product_service = $this::$container->get('test_alias.catalog.product.service');
        foreach ($this->getMock() as $productFromMock) {
            $product = $product_service->getRepository()->findOneBySku($productFromMock['sku']);
            $this->assertNull(
                $product_service->delete($product)
            );

        }

    }
}