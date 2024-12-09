<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'nro_telefono' => $this->faker->phoneNumber(),
            'cedula_cliente' => $this->faker->unique()->numerify('########'), // 8 dígitos
            'sexo' => $this->faker->randomElement(['F', 'M']), // Sexo aleatorio
        ];
    }
}
