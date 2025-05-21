<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EventoTest extends DuskTestCase
{
    // No es necesario incluir 'DatabaseMigrations' aquí si ya está en DuskTestCase.php

    /**
     * Test para crear un accidente básico.
     *
     * @return void
     */
    public function testCrearAccidenteBasico()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ruta/a/tu/formulario')  // Cambia esto por la URL a tu formulario de evento
                    ->type('campo_nombre', 'Accidente de prueba') // Cambia 'campo_nombre' por el nombre de tu campo
                    ->select('tipo_evento', 'accidente') // Cambia 'tipo_evento' y el valor 'accidente' según corresponda
                    ->press('Crear Evento') // Cambia 'Crear Evento' por el nombre del botón que deseas presionar
                    ->assertSee('Evento creado exitosamente'); // Cambia esto por el texto que se muestra después de crear el evento
        });
    }

    /**
     * Test de ejemplo básico.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Bienvenido a tu sistema');
        });
    }
}
