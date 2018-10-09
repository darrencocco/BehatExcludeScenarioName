<?php
/**
 * Created by PhpStorm.
 * User: Narayan
 * Date: 24/09/18
 * Time: 9:09 AM
 */


namespace Monash\BehatExcludeScenarioName\Filter;


use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\ScenarioInterface;
use Behat\Gherkin\Filter\SimpleFilter;

/**
 * Filters scenarios by feature/scenario name.
 *exclude-scenario-names:
 * @author Narayan <narayana.belurmanjunathaiah@monash.edu>
 */
class ExcludeScenarioNameFilterGherkin extends SimpleFilter
{

    protected $filterString = array();

    /**exclude-scenario-names:
     * Initializes filter.
     *
     * @param string $filterString Name filter string
     */
    public function __construct($filterString)
    {

        foreach ($filterString as $string ) {
            $this->filterString[] = trim($string);
        }

    }

    /**
     * Checks if Feature matches specified filter.
     *
     * @param FeatureNode $feature Feature instance
     *
     * @return Boolean
     */
    public function isFeatureMatch(FeatureNode $feature)
    {
        if(is_array($this->filterString)) {
            foreach ($this->filterString as $string) {
                if ($this->checkFeatureMatch($feature, $string)) {
                    return true;
                }
            }
        } else {
            return $this->checkFeatureMatch($feature, $this->filterString);
        }
        return false;
    }

    private function checkFeatureMatch(FeatureNode $feature, $string) {
        if ('/' === $string) {
            return 1 === preg_match($string, $feature->getTitle());
        }

        return false !== mb_strpos($feature->getTitle(), $string, 0, 'utf8');
    }

    /**
     * Checks if scenario or outline matches specified filter.
     *
     * @param ScenarioInterface $scenario Scenario or Outline node instance
     *
     * @return Boolean
     */
    public function isScenarioMatch(ScenarioInterface $scenario)
    {

        if (is_array($this->filterString)) {
            foreach ($this->filterString as $string) {
                if ($this->checkScenarioMatch($scenario, $string)) {
                    return false;
                }
            }
        } else {
            return $this->checkScenarioMatch($scenario, $this->filterString);
        }

        return true;
    }

    private function checkScenarioMatch(ScenarioInterface $scenario, $string) {
        if ('/' === $string && 1 === preg_match($string, $scenario->getTitle())) {
            return true;
        } elseif (false !== mb_strpos($scenario->getTitle(), $string, 0, 'utf8')) {
            return true;
        }

        return false;
    }
}
