<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    protected $model = Proveedor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $negocios = [
            'Rincón Creativo',
            'Delicias Naturales',
            'Estilo Moderno',
            'Café Sostenible',
            'Innovaciones Gourmet',
            'Tienda Única',
            'Mundo Sabroso',
            'Arte y Sabor',
            'Soluciones Ecológicas',
            'Delicias Caseras',
            'Estudio Elegante',
            'Café Rápido',
            'Rincón del Té',
            'Innovación Digital',
            'Sabor Tradicional',
            'Tienda Verde',
            'Estilo Clásico',
            'Mundo de Frutas',
            'Delicias Urbanas',
            'Café Artesanal',
            'Rincón del Arte',
            'Sabor Auténtico',
            'Tienda de Sueños',
            'Innovación Creativa',
            'Delicias del Mar',
            'Estilo Único',
            'Café y Cultura',
            'Rincón del Vino',
            'Mundo de Sabores',
            'Soluciones Prácticas',
            'Delicias de Temporada',
            'Estudio de Diseño',
            'Café y Compañía',
            'Rincón de la Música',
            'Innovaciones Saludables',
            'Tienda de Regalos',
            'Estilo Bohemio',
            'Mundo de Aromas',
            'Delicias Exóticas',
            'Café y Conversaciones',
            'Rincón de la Moda',
            'Sabor Internacional',
            'Tienda de Bienestar',
            'Innovación en Casa',
            'Delicias Vegetarianas',
            'Estilo Minimalista',
            'Café y Arte',
            'Rincón del Chocolate',
            'Mundo de Texturas',
            'Soluciones Creativas'
        ];

        return [
            'cedula_representante' => $this->faker->unique()->numerify('########'),
            'email'  => $this->faker->unique()->safeEmail(),
            'nombre_representante' => $this->faker->name(),
            'rif' => $this->generateCedula(),
            'nombre' => $negocios[array_rand($negocios)],
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber()
        ];
    }

    private function generateCedula()
    {
        // Letras iniciales permitidas
        $letras = ['V', 'E', 'J', 'G'];
        // Selecciona una letra al azar
        $letraInicial = $this->faker->randomElement($letras);
        // Genera 8 dígitos
        $numeros = $this->faker->numerify('########');

        return $letraInicial . $numeros; // Combina letra y números
    }
}
