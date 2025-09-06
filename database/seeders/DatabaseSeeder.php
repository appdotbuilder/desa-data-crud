<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\DemografiPenduduk;
use App\Models\Umkm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin with MD5 hash as requested
        User::create([
            'name' => 'Super Administrator',
            'email' => 'adm.posko@gmail.com',
            'password' => hash('md5', 'admin123'), // Use hash() function instead of md5()
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // Create location hierarchy
        $kabupaten = Kabupaten::create([
            'nama' => 'Kabupaten Contoh',
            'keterangan' => 'Kabupaten untuk demo sistem'
        ]);

        $kecamatan1 = Kecamatan::create([
            'kabupaten_id' => $kabupaten->id,
            'nama' => 'Kecamatan Utara',
            'keterangan' => 'Kecamatan bagian utara'
        ]);

        $kecamatan2 = Kecamatan::create([
            'kabupaten_id' => $kabupaten->id,
            'nama' => 'Kecamatan Selatan',
            'keterangan' => 'Kecamatan bagian selatan'
        ]);

        $desa1 = Desa::create([
            'kecamatan_id' => $kecamatan1->id,
            'nama' => 'Desa Maju',
            'keterangan' => 'Desa dengan potensi tinggi'
        ]);

        $desa2 = Desa::create([
            'kecamatan_id' => $kecamatan1->id,
            'nama' => 'Desa Berkembang',
            'keterangan' => 'Desa yang sedang berkembang'
        ]);

        $desa3 = Desa::create([
            'kecamatan_id' => $kecamatan2->id,
            'nama' => 'Desa Sejahtera',
            'keterangan' => 'Desa yang sudah sejahtera'
        ]);

        // Create admin users for each level
        User::create([
            'name' => 'Admin Kabupaten Contoh',
            'email' => 'admin.kabupaten@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_kabupaten',
            'kabupaten' => 'Kabupaten Contoh',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin Kecamatan Utara',
            'email' => 'admin.kecamatan.utara@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_kecamatan',
            'kabupaten' => 'Kabupaten Contoh',
            'kecamatan' => 'Kecamatan Utara',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin Desa Maju',
            'email' => 'admin.desa.maju@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_desa',
            'kabupaten' => 'Kabupaten Contoh',
            'kecamatan' => 'Kecamatan Utara',
            'desa' => 'Desa Maju',
            'email_verified_at' => now(),
        ]);

        // Create sample demographic data
        $pendudukData = [
            [
                'desa_id' => $desa1->id,
                'kk' => '1234567890123456',
                'nik' => '1234567890123456',
                'nama' => 'Ahmad Supriyadi',
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '1985-05-15',
                'alamat' => 'Jl. Merdeka No. 123',
                'pendidikan_terakhir' => 'slta',
                'agama' => 'islam',
                'pekerjaan' => 'Petani',
            ],
            [
                'desa_id' => $desa1->id,
                'kk' => '1234567890123456',
                'nik' => '1234567890123457',
                'nama' => 'Siti Aminah',
                'jenis_kelamin' => 'perempuan',
                'tanggal_lahir' => '1990-08-22',
                'alamat' => 'Jl. Merdeka No. 123',
                'pendidikan_terakhir' => 'sltp',
                'agama' => 'islam',
                'pekerjaan' => 'Ibu Rumah Tangga',
            ],
            [
                'desa_id' => $desa2->id,
                'nik' => '1234567890123458',
                'kk' => '2234567890123456',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'laki-laki',
                'tanggal_lahir' => '1978-03-10',
                'alamat' => 'Jl. Proklamasi No. 456',
                'pendidikan_terakhir' => 's1',
                'agama' => 'islam',
                'pekerjaan' => 'Guru',
            ],
        ];

        foreach ($pendudukData as $data) {
            DemografiPenduduk::create($data);
        }

        // Create sample UMKM data
        $umkmData = [
            [
                'desa_id' => $desa1->id,
                'jenis_umkm' => 'Warung Sembako',
                'lokasi_x' => -7.250445,
                'lokasi_y' => 112.768845,
                'pemilik' => 'Ahmad Supriyadi',
            ],
            [
                'desa_id' => $desa1->id,
                'jenis_umkm' => 'Toko Kelontong',
                'lokasi_x' => -7.251445,
                'lokasi_y' => 112.769845,
                'pemilik' => 'Siti Rahma',
            ],
            [
                'desa_id' => $desa2->id,
                'jenis_umkm' => 'Bengkel Motor',
                'lokasi_x' => -7.252445,
                'lokasi_y' => 112.770845,
                'pemilik' => 'Budi Santoso',
            ],
        ];

        foreach ($umkmData as $data) {
            Umkm::create($data);
        }

        // Create more sample users
        User::factory(5)->create([
            'role' => 'admin_desa',
            'kabupaten' => 'Kabupaten Contoh',
            'kecamatan' => 'Kecamatan Utara',
            'desa' => 'Desa Maju',
        ]);
    }
}