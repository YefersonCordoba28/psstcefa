<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations; // Asegúrate de importar el trait solo una vez
use Laravel\Dusk\DuskTestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use DatabaseMigrations;  // Este trait ya está aquí, no es necesario agregarlo nuevamente en los tests

    /**
     * Prepare for Dusk test.
     *
     * @return void
     */
    public static function prepareForTests()
    {
        // Cualquier configuración previa para los tests
    }
}
