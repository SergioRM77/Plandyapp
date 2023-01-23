<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre_completo' => fake()->name(),
            'alias'=>fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefono'=>fake()->e164phoneNumber(),
            'direccion'=>fake()->text(),
            'localidad'=>fake()->text(),
            'codigo_postal'=>random_int(0,99999),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            
            'password' => 1234, // password
            'remember_token' => Str::random(10)
            

        ];
    }
}
