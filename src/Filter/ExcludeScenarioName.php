<?php
/**
 * Created by PhpStorm.
 * User: Narayan
 * Date: 19/09/18
 * Time: 12:46 PM
 */

namespace Monash\BehatExcludeScenarioName\Filter;


use Symfony\Component\Console\Input\InputOption;
use Behat\Testwork\Specification\Filter\SpecificationFilterProvider;

/**
 * Filters scenarios by feature/scenario name.
 *exclude-scenario-names:
 * @author Narayan <narayana.belurmanjunathaiah@monash.edu>
 */

class ExcludeScenarioName implements SpecificationFilterProvider {
    /**
     * @var SpecificationFilterProvider[]
     */
    public function getName() {
        return 'exclude-scenario-names';
    }

    /**
     * @return mixed[]
     */
    public function getCommandOptions() {
        return array(InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            "Only executeCall the feature elements which match part" . PHP_EOL .
            "of the given name or regex.");
    }

    public function build($filterData) {
        return new ExcludeScenarioNameFilterGherkin($filterData);
    }
}