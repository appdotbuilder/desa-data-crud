<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DemografiPenduduk>
 */
class DemografiPendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::factory(),
            'kk' => fake()->numerify('################'),
            'nik' => fake()->unique()->numerify('################'),
            'nama' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'tanggal_lahir' => fake()->dateTimeBetween('-65 years', '-17 years')->format('Y-m-d'),
            'alamat' => fake()->address(),
            'pendidikan_terakhir' => fake()->randomElement(['sd', 'sltp', 'slta', 's1', 's2', 's3']),
            'agama' => fake()->randomElement(['islam', 'katolik', 'protestan', 'hindu', 'budha', 'konghucu', 'kepercayaan']),
            'pekerjaan' => fake()->jobTitle(),
        ];
    }
}