<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrearProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_no_se_puede_crear_producto_sin_datos(): void
    {
        $rol = Role::create([
            'nombre' => 'administrador',
        ]);

        $user = User::factory()->create([
            'role_id' => $rol->id,
        ]);

        $response = $this->actingAs($user)->post('/panel/productos', []);

        $response->assertSessionHasErrors([
            'categoria_id',
            'nombre',
            'descripcion',
            'precio',
            'stock',
            'activo',
        ]);
    }
}