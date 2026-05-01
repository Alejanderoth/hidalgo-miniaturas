<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    public function test_se_puede_crear_pedido(): void
    {
        $rol = Role::create([
            'nombre' => 'cliente',
        ]);

        $user = User::factory()->create([
            'role_id' => $rol->id,
        ]);

        $categoria = Category::create([
            'nombre' => 'Categoría test',
        ]);

        $producto = Product::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Producto test',
            'descripcion' => 'Descripción test',
            'precio' => 10,
            'stock' => 10,
            'imagen' => 'test.jpg',
            'activo' => 1,
        ]);

        $carrito = [
            $producto->id => [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ],
        ];

        $response = $this->actingAs($user)
            ->withSession(['carrito' => $carrito])
            ->post('/pedido/confirmar');

        $response->assertRedirect('/mi-cuenta');

        $this->assertDatabaseCount('pedidos', 1);
        $this->assertDatabaseCount('detalle_pedidos', 1);
    }
}