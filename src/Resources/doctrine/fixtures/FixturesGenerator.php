<?php

namespace Mtt\CatalogBundle\Resources\doctrine\fixtures;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Mtt\CatalogBundle\Entity\Category;
use Mtt\CatalogBundle\Entity\Characteristic;
use Mtt\CatalogBundle\Entity\CharacteristicValue;
use Mtt\CatalogBundle\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixturesGenerator implements FixturesGeneratorInterface
{
    protected $container;
    protected $em;

    public function __construct(ContainerInterface $container)
    {
        $this->em = $container->get('doctrine')->getEntityManager();
        $this->container = $container;
    }

    /**
     * TODO: seperate this method
     * @param int $products
     * @param int $categories
     * @param int $characteristics
     * @param int $charValues
     */
    public function loadFakeData(Collection $options)
    {
       // int $products = 100, int $categories = 5, int $characteristics = 2, int $charValues = 100
        if(!$options->get('products')){
            $products = 100;
        }
        if(!$options->get('categories')){
            $categories = 5;
        }
        if(!$options->get('characteristics')){
            $characteristics = 2;
        }
        if(!$options->get('charValues')){
            $charValues = 100;
        }

        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= $categories; $i++) {
            $classEntity = $this->getEntityByAlias(Category::CATEGORY_ALIAS);
            $category = new $classEntity;
            $category->setName($faker->unique()->words(3, true));
            $category->setSlug($faker->slug(2));
            $category->setDescription($faker->text(mt_rand(150, 400)));
            $this->em->persist($category);

            $categoryList[] = $category;
        }


        for ($i = 0; $i <= $characteristics; $i++) {
            $classEntity = $this->getEntityByAlias(Characteristic::CHARACTERISTIC_ALIAS);
            $characteristic = new $classEntity;
            $characteristic->setName($faker->unique()->words(2, true));
            $characteristic->setSlug($faker->slug(2));
            $this->em->persist($characteristic);

            $characteristicsList[] = $characteristic;
        }

        for ($i = 0; $i <= $charValues; $i++) {
            $classEntity = $this->getEntityByAlias(CharacteristicValue::CHARACTERISTIC_VALUES_ALIAS);
            $characteristicsValue = new $classEntity;
            $characteristicsValue->setValue($faker->unique()->word);
            $characteristicsValue->setSlug($faker->slug(2));
            $characteristicsValue->setCharacteristic($characteristicsList[mt_rand(0, count($characteristicsList) - 1)]);
            $this->em->persist($characteristicsValue);

            $characteristicsValueList[] = $characteristicsValue;
        }
        /*
                price: '<randomFloat(2, 10, 3000)>'
                id_erp (unique): '<numerify(0a#b-######)>'
                characteristicsValues (unique): '3x @charvalue*'
                type: 'simple'
                slug (unique): '<word()><word()>'
                categories (unique): '<numberBetween(1, 4)>x @category*'
                description: '<text(400)>'
          */
        for ($i = 0; $i <= $products; $i++) {
            $classEntity = $this->getEntityByAlias(Product::PRODUCT_ALIAS);
            $product = new $classEntity;
            $product->setName($faker->unique()->sentence(4));
            $product->setPrice($faker->randomFloat(2, 10, 3000));
            $product->setIdErp($faker->unique()->numerify('0a#b-######'));

            foreach (array_rand($categoryList, 2) as $categoryRandomKey) {
                $product->addCategory($categoryList[$categoryRandomKey]);
            }

            foreach (array_rand($characteristicsValueList, 3) as $characteristicsValueRandomKey) {
                $product->addCharacteristicsValues($characteristicsValueList[$characteristicsValueRandomKey]);
            }

            $product->setDescription($faker->text(mt_rand(200, 1000)));
            $this->em->persist($product);

            $productsList[] = $product;
        }


        $this->em->flush();
    }

    public function truncateBundleTables()
    {

        $this->truncateTable(Product::PRODUCT_ALIAS);
        $this->truncateTable(Category::CATEGORY_ALIAS);
        $this->truncateTable(Characteristic::CHARACTERISTIC_ALIAS);
        $this->truncateTable(CharacteristicValue::CHARACTERISTIC_VALUES_ALIAS);

    }

    protected function truncateTable(string $entityAlias)
    {

        $this->em->createQuery("DELETE from " . $this->getEntityByAlias($entityAlias) . " p")->execute();
        /* $q->execute();


         $connection = $this->em->getConnection();
         $platform   = $connection->getDatabasePlatform();


         $entityClassName = $this->getEntityByAlias($entityAlias);
         $cmd = $this->em->getClassMetadata($entityClassName);

         $connection->query('SET FOREIGN_KEY_CHECKS=0');
         $connection->executeUpdate($platform->getTruncateTableSQL($cmd->getTableName(), true));
         $connection->query('SET FOREIGN_KEY_CHECKS=1');*/

        /*$entityClassName = $this->getEntityByAlias($entityAlias);
        $cmd = $this->em->getClassMetadata($entityClassName);
        $connection = $this->em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        */
    }

    protected function getEntityByAlias($entityAlias)
    {
        return $this->container->getParameter($entityAlias);
    }
}