<?php

namespace Mtt\CatalogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MttCatalogExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
 /*   public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

    }*/

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $myBundleConfig = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('mtt_catalog.product_entity', $myBundleConfig['product_entity']);
        $container->setParameter('mtt_catalog.category_entity', $myBundleConfig['category_entity']);
        $container->setParameter('mtt_catalog.characteristic', $myBundleConfig['characteristic_entity']);
        $container->setParameter('mtt_catalog.characteristic_value', $myBundleConfig['characteristic_value_entity']);

        if(isset($myBundleConfig['easy_admin_integration'])) {
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
        $interfaces = [
            'Mtt\EasyPageBundle\Entity\PageEntityInterface' => $container->getParameter('mtt_easy_page.page_entity')
        ];
        $def = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');
        foreach ($interfaces as $entityInterface => $resolvedClass){
            $def->addMethodCall('addResolveTargetEntity', array($entityInterface, $resolvedClass, array()));
        }
        /*  $def = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');
          dump($def);
          die($container->getParameter('mtt_easy_page.page_entity'));*/
    }
}
