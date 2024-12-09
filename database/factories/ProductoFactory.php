<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cod_proveedor' => $this->faker->numberBetween(1, 51), // Número aleatorio entre 1 y 51
            'nombre' => $this->faker->word(), // Nombre del producto
            'marca' => $this->faker->word(), // Marca del producto
            'cant_stock' => $this->faker->numberBetween(1, 100), // Cantidad entre 1 y 100
            'precio_venta' => $this->faker->randomFloat(2, 10, 1000), // Precio entre 10.00 y 1000.00
            'precio_proveedor' => $this->faker->randomFloat(2, 5, 500), // Precio entre 5.00 y 500.00
        ];
    }
}
