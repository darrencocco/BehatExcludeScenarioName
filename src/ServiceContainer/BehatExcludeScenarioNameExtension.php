<?php
/**
 * Created by PhpStorm.
 * User: Narayana
 * Date: 19/09/18
 * Time: 11:58 AM
 */

namespace Monash\BehatExcludeScenarioName\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class BehatExcludeScenarioNameExtension implements Extension {

    const SCENARIO_NAME_FILTER_ID = 'monash.behat-exclude-scenario-name';
    const FILTER_TAG = 'specifications.filter';

    # The tag 'exclude_scenario_names' is '-' separated inside yml file.
    # Maintain the '_' here as per the symfony requirements
    public function getConfigKey()
    {
        return 'exclude_scenario_names';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager):void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder): void
    {
    }

    /**
    * {@inheritdoc}
    */
    public function load(ContainerBuilder $container, array $config)
    {
        $this->loadExcludeScenarioNameFilter($container);
    }

    /**
    * {@inheritdoc}
    */
    public function process(ContainerBuilder $container)
    {
    }

    /**
    * Loads specification finder.
    *
    * @param ContainerBuilder $container
    */

    private function loadExcludeScenarioNameFilter(ContainerBuilder $container)
    {
        $definition = new Definition('Monash\BehatExcludeScenarioName\Filter\ExcludeScenarioName');
        $definition->addTag(\Behat\Testwork\Specification\ServiceContainer\SpecificationExtension::FILTER_TAG, array('priority' => 50));
        $container->setDefinition(\Behat\Testwork\Specification\ServiceContainer\SpecificationExtension::FILTER_TAG . '.exclude-scenario-names', $definition);

    }
}


