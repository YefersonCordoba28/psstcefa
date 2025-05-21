<?php
<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class DuskTestCase extends BaseTestCase
{
    use DatabaseMigrations;

    /**
     * Prepare for Dusk test.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        // Indica que se use Firefox u otro navegador aquí si es necesario
        putenv('BROWSER=firefox');
    }

    /**
     * Create the browser instance.
     *
     * @return \Laravel\Dusk\Browser
     */
    protected function driver()
    {
        // Configura el navegador que deseas usar, como Firefox
        return \Facebook\WebDriver\Remote\RemoteWebDriver::create(
            $this->getDriverUrl(),
            \Facebook\WebDriver\Remote\DesiredCapabilities::firefox()
        );
    }
}
