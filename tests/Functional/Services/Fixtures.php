<?php

use Doctrine\Common\Collections\ArrayCollection;
$mock = new ArrayCollection();


$charMocks = new ArrayCollection(
    array(
        ["id_erp" => '00t111f122', 'active' => true, 'url_key' => "weight", "name"=>"weight"],
        ["id_erp" => 'sfdfsd/3423', 'active' => true, 'url_key' => "color", "name"=>"color"])
);

$mock->set('charMocks', $charMocks);


$charValueTestMocks = new ArrayCollection(
    array(

        [
            "id_erp" => '12122', 'active' => true, 'url_key' => "size", "name"=>"size",
            'values' => new ArrayCollection(array(
                ['value' => "L"],
                ['value' => "XL"]
                )
            )
        ]
    )
);
$mock->set('charValueTestMocks', $charValueTestMocks);

$productsMocks = new ArrayCollection(
    array(
        ["sku" => '00t111f122', 'idErp' => '000001', 'name' => "Тестовый товар 1"],
        ["sku" => 'sfdfsd/3423', 'idErp' => '000002', 'name' => "Тестовый товар 2"]
    )
);

$mock->set('productsMocks', $productsMocks);
