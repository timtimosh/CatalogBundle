<?php
namespace Mtt\CatalogBundle\DependencyInjection;

use Mtt\CatalogBundle\Entity\Category;
use Mtt\CatalogBundle\Entity\Characteristic;
use Mtt\CatalogBundle\Entity\CharacteristicValue;
use Mtt\CatalogBundle\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;


/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MttCatalogExtension extends Extension implements PrependExtensionInterface, CompilerPassInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $myBundleConfig = $this->processConfiguration(new Configuration(), $configs);
        $container->setParameter(Product::PRODUCT_ALIAS, $myBundleConfig['product_entity']);
        $container->setParameter(Category::CATEGORY_ALIAS, $myBundleConfig['category_entity']);
        $container->setParameter(Characteristic::CHARACTERISTIC_ALIAS, $myBundleConfig['characteristic_entity']);
        $container->setParameter(CharacteristicValue::CHARACTERISTIC_VALUES_ALIAS, $myBundleConfig['characteristic_value_entity']);
        $container->setParameter('mtt_catalog.products_per_page', $myBundleConfig['products_per_page']);
        $container->setParameter('mtt_catalog.default_product_limit', $myBundleConfig['default_product_limit']);

        $container->setParameter('mtt_catalog.image_path_to_product', $myBundleConfig['image_path'].'/product');


        if(!empty($myBundleConfig['easy_admin_integration'])) {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../EasyAdminIntegration/Resources/config'));
            $loader->load('superadmin.yml');
        }
    }

    /**
     * @param ContainerBuilder $container
     * process() is called after all extensions are loaded
     */
    public function process(ContainerBuilder $container)
    {

    }
}
