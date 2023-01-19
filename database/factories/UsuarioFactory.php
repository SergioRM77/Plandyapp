<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => 1234, // password
            'remember_token' => fake()->int,
            'alias'=>fake()->unique()->name(),
            'telefono'=>fake()->int,
            'direccion'=>fake()->text(),
            'localidad'=>fake()->text(),
            'codigo_postal'=>fake()->int,
            'created_at',
            'updated_at'
        ];
    }
}
