<?php

namespace Mtt\CatalogBundle\Resources\doctrine\fixtures;

use Doctrine\Common\Collections\Collection;

interface FixturesGeneratorInterface
{
    public function loadFakeData(Collection $options);

    public function truncateBundleTables();
}