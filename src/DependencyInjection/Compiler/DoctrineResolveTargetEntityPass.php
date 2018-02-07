<?php
namespace Mtt\CatalogBundle\DependencyInjection\Compiler;

use Doctrine\ORM\Version;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineResolveTargetEntityPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        // resolve_target_entities
        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        $interfaces = [
            'Mtt\Core\Interfaces\Catalog\Entity\ProductInterface' => $container->getParameter('mtt_catalog.product_entity'),
            'Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface' => $container->getParameter('mtt_catalog.category_entity'),
            'Mtt\Core\Interfaces\Catalog\Entity\CharacteristicInterface' => $container->getParameter('mtt_catalog.characteristic_entity'),
            'Mtt\Core\Interfaces\Catalog\Entity\CharacteristicValueInterface' => $container->getParameter('mtt_catalog.characteristic_value_entity')
        ];

        foreach ($interfaces as $entityInterface => $resolvedClass){
            $definition->addMethodCall('addResolveTargetEntity', array($entityInterface, $resolvedClass, array()));
        }

        if (version_compare(Version::VERSION, '2.5.0-DEV') < 0) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        } else {
            $definition->addTag('doctrine.event_subscriber', array('connection' => 'default'));
        }
    }
}