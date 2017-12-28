<?php

namespace CatalogBundle\Tests\Functional\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use CatalogBundle\Tests\Functional\AbstractTest;
use CatalogBundle\Tests\Functional\Services\CharServiceTest;

class CharValueServiceTest extends AbstractTest
{
    protected $mockName = 'charValueTestMocks';

    public function testSave()
    {
        $char = $this->createChar();
        // $char_service = $this::$container->get('catalog_char');
        $mock = $this->getMock()->first();
        $mock = $mock['values']->first();
        $char_value_service = $this::$container->get('catalog_char_value');

        $new_char_value = $char_value_service->create();
        $new_char_value->setValue($mock['value']);
        $new_char_value->setChar($char);
        $this->assertNull(
            $char_value_service->save($new_char_value)
        );
    }


    protected function createChar()
    {
        $char_service = $this::$container->get('catalog_char');
        $mock = $this->getMock()->first();
        $char = $char_service->create();
        $char->setIdErp($mock['id_erp']);
        $char->setActive($mock['active']);
        $char->setUrlKey($mock['url_key']);
        $char->setName($mock['name']);
        $char_service->save($char);
        return $char;
    }

    public function deleteTest()
    {
        $charServiceValue = $this::$container->get('catalog_char_value');
        $allCharsValues = $charServiceValue->getRepository()->findAll();
        $this->assertGreaterThan(
            0, count($allCharsValues)
        );
        foreach ($allCharsValues as $charEntity) {
            $this->assertTrue(
                $charServiceValue->delete($charEntity)
            );
        }
    }
}