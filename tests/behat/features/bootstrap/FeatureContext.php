<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Event\SuiteEvent,
    Behat\Behat\Event\ScenarioEvent;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $app;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $config = require __DIR__ . '/../../../../app/config/config.php';
        $this->app = require __DIR__ . '/../../../../app/app.php';

        $this->useContext(
            'api',
            new Behat\CommonContexts\WebApiContext($config['basePath'])
        );
    }

    /**
     * @BeforeScenario
     */
    public function enableAllFeeds(ScenarioEvent $event)
    {
        $repo = $this->app['feeds.repository'];
        $feeds = $repo->all();

        array_walk($feeds, function ($feed) use ($repo) {
            $repo->setStatus($feed, true);
        });
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
}
