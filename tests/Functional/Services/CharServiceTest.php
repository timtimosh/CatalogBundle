<?php

namespace Mtt\CatalogBundle\Functional\Services;


use Doctrine\Common\Collections\ArrayCollection;
use Mtt\Core\Interfaces\Catalog\Entity\CharInterface;
use Mtt\CatalogBundle\Tests\Functional\Services\AbstractTest;

class CharServiceTest extends AbstractTest
{
    protected $mockName = 'charMocks';

    public function testCharCreation()
    {
        $charService = $this::$container->get('catalog.char.service');
        $char = $charService->create();

        $this->assertTrue($char instanceof CharInterface);
    }

    public function testCharSave()
    {
        $char_service = $this::$container->get('catalog.char.service');

        foreach ($this->getMock() as $mock) {
            $char = $char_service->create();
            $char->setIdErp($mock['id_erp']);
            $char->setActive($mock['active']);
            $char->setUrlKey($mock['url_key']);
            $char->setName($mock['name']);
            $this->assertNull(
                $char_service->save($char)
            );
        }
    }

    public function testCharFind()
    {
        $char_service = $this::$container->get('catalog.char.service');
        $mock = $this->getMock()->first();
        $char = $char_service->getRepository()->findOneByIdErp($mock['id_erp']);
        $this->assertTrue($char instanceof CharInterface);
    }

    public function testCharDelete()
    {
        $charService = $this::$container->get('catalog.char.service');
        $allChars = $charService->getRepository()->findAll();
        $this->assertGreaterThan(
            0, count($allChars)
        );
        foreach ($allChars as $charEntity) {
            $this->assertNull(
                $charService->delete($charEntity)
            );
        }
    }

}