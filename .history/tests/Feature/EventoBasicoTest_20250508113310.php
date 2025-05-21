<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventoBasicoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_acceder_a_la_pagina_de_crear_evento()
    {
        $response = $this->get('/eventos/create');

        $response->assertStatus(200); // Verifica que carga correctamente
    }
}
