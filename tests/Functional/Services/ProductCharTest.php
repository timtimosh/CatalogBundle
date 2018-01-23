<?php

namespace Mtt\CatalogBundle\Tests\Functional\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use Mtt\CatalogBundle\Tests\Functional\AbstractTest;
use Mtt\Core\Interfaces\Catalog\Entity\CharValueInterface;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class ProductCharTest extends AbstractTest
{
    protected $mockName = 'productEntityTestMocks';
    protected static $product;


    public function testAttachChar()
    {
        $this->createCharValues();
        $charValueService = $this::$container->get('catalog.charvalue.service');
        $allAviableChars = $charValueService->getRepository()->findAll();
        $product = $this->getProduct();
        $productCharService = $this::$container->get('catalog.productchar.service');
        $this->assertGreaterThan(
            0, count($allAviableChars)
        );
        foreach ($allAviableChars as $charValueEntity) {
            $productChar = $productCharService->create();
            $productChar->setProduct($product);
            $productChar->setCharValue($charValueEntity);
            $this->assertNull(
                $productCharService->save($productChar)
            );
        }
    }

    public function testProductHasAttachedChars()
    {
        $product = $this->getProduct();
        $product_service = $this::$container->get('catalog.product.service');
        $product = $product_service->find($product->getProductId());
        $this->assertGreaterThan(
            0,
            $product->getCharsCollection()->count()
        );
    }

    public function testDeleteAttachedChar()
    {
        $product = $this->getProduct();
        $product_service = $this::$container->get('catalog.product.service');
        $productCharService = $this::$container->get('catalog.productchar.service');
        $product = $product_service->find($product->getProductId());
        foreach ($product->getCharsCollection() as $charCollectionEntity) {
            $this->assertNull(
                $productCharService->delete($charCollectionEntity)
            );
        }

        $this->assertEquals(
            0,
            $product->getCharsCollection()->count()
        );
    }

    protected function getProduct(): ProductInterface
    {
        if (!$this::$product) $this::$product = $this->createProduct();

        return $this::$product;
    }

    protected function createProduct()
    {
        $product_service = $this::$container->get('catalog.product.service');
        $productFromMock = $this->getMock('productsMocks')->first();
        $product = $product_service->create();
        $product->setSku($productFromMock['sku']);
        $product->setIdErp($productFromMock['idErp']);
        $product->setName($productFromMock['name']);
        $product_service->save($product);
        return $product;
    }

    protected function createCharValues()
    {
        $char_service = $this::$container->get('catalog.char.service');
        $mock = $this->getMock('charValueTestMocks')->first();
        $char = $char_service->create();
        $char->setIdErp($mock['id_erp']);
        $char->setActive($mock['active']);
        $char->setUrlKey($mock['url_key']);
        $char->setName($mock['name']);
        $char_service->save($char);

        $char_value_service = $this::$container->get('catalog.charvalue.service');
        $mock = $this->getMock('charValueTestMocks')->first();
        foreach ($mock['values'] as $charValueMock) {
            $new_char_value = $char_value_service->create();
            $new_char_value->setValue($charValueMock['value']);
            $new_char_value->setChar($char);

            $char_value_service->save($new_char_value);
        }
    }

}