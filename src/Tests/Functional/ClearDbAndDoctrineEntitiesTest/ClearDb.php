<?php

namespace CatalogBundle\Tests\Functional\ClearDbAndDoctrineEntitiesTest;


use Doctrine\Common\Collections\ArrayCollection;
use ShopCoreBundle\Interfaces\Catalog\CharInterface;
use CatalogBundle\Tests\Functional\AbstractTest;

class ClearDb extends AbstractTest
{

    public static function setUpBeforeClass(){
        parent::setUpBeforeClass();
        static::createDBForTest();
    }

    public function testNowarning(){
        $this->assertTrue(true);
    }
}