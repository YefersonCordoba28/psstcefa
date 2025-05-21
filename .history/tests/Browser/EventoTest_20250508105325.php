<?php

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EventoTest extends DuskTestCase
{
    public function testCrearAccidenteBasico()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/eventos/crear')
                    ->select('tipo', 'accidente')
                    ->type('descripcion', 'Accidente de prueba')
                    ->press('Guardar')
                    ->assertSee('Evento registrado con éxito');
        });
    }
}
