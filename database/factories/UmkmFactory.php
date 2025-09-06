<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisUmkm = [
            'Warung Sembako', 'Toko Kelontong', 'Bengkel Motor', 'Salon Kecantikan',
            'Warung Makan', 'Toko Pakaian', 'Penjahit', 'Laundry', 'Fotocopy',
            'Bengkel Las', 'Toko Elektronik', 'Apotek', 'Barbershop'
        ];

        return [
            'desa_id' => Desa::factory(),
            'jenis_umkm' => fake()->randomElement($jenisUmkm),
            'lokasi_x' => fake()->latitude(-10, -5),
            'lokasi_y' => fake()->longitude(105, 115),
            'pemilik' => fake()->name(),
            'foto' => null,
        ];
    }
}