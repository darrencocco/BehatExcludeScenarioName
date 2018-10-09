## Exclude Scenario Name Extension
Allows to exclude scenarios from a feature file

##Usage
1. Install plugin:

    ```bash
    $composer require Narayanabelur/BehatExcludeScenarioName --dev
    ```  
   
2. Configure the filter in behat.yml file as below:
    Add the filter under your suite in which you want to exclude scenarios

    ```yml
    # behat.yml
    default:    
        filters:
        exclude-scenario-names:
            - scenario 1
            - scenario 2
            - scenario 3
    ```

3. Add below lines as extension to make it available for Extension manager:

    ```yml
    # behat.yml
    default:
    ...
        extensions:
            Narayanabelur\BehatExcludeScenarioName: ~
    ``` 
    
    where, '~' means empty arguments. Scenarios to exclude should be added under
   'filters' tag in step 2.
  
4. That's it, it excludes all the scenarios mentioned under filters:

