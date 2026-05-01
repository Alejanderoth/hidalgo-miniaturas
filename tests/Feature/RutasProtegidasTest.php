<?php

namespace Tests\Feature;

use Tests\TestCase;

class RutasProtegidasTest extends TestCase
{
    public function test_usuario_no_autenticado_no_accede_al_panel(): void
    {
        $response = $this->get('/panel');

        $response->assertRedirect('/login');
    }
}