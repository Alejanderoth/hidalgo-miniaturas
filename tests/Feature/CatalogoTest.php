<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogoTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalogo_carga_correctamente(): void
    {
        $response = $this->get('/catalogo');

        $response->assertStatus(200);
    }
}