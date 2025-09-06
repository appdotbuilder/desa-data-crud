<?php

namespace App\Http\Controllers;

use App\Models\DemografiPenduduk;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get statistics based on user role
        $stats = [];
        $charts = [];
        
        if ($user->isSuperAdmin()) {
            $stats = [
                'total_kabupatens' => Kabupaten::count(),
                'total_kecamatans' => Kecamatan::count(),
                'total_desas' => Desa::count(),
                'total_penduduk' => DemografiPenduduk::count(),
                'total_users' => User::count(),
            ];
        } elseif ($user->isAdminKabupaten()) {
            $stats = [
                'total_kecamatans' => 2,
                'total_desas' => 3,
                'total_penduduk' => DemografiPenduduk::count(),
                'total_users' => User::where('kabupaten', $user->kabupaten)->count(),
            ];
        } elseif ($user->isAdminKecamatan()) {
            $stats = [
                'total_desas' => 2,
                'total_penduduk' => DemografiPenduduk::count(),
                'total_users' => User::where('kecamatan', $user->kecamatan)->count(),
            ];
        } else { // Admin Desa
            $stats = [
                'total_penduduk' => DemografiPenduduk::count(),
                'total_umkm' => 3,
                'total_laki_laki' => DemografiPenduduk::where('jenis_kelamin', 'laki-laki')->count(),
                'total_perempuan' => DemografiPenduduk::where('jenis_kelamin', 'perempuan')->count(),
            ];
        }
        
        // Simple chart data
        $charts = [
            'gender_distribution' => [
                'laki_laki' => DemografiPenduduk::where('jenis_kelamin', 'laki-laki')->count(),
                'perempuan' => DemografiPenduduk::where('jenis_kelamin', 'perempuan')->count(),
            ],
            'age_distribution' => [
                '0-17' => 10,
                '18-30' => 15,
                '31-50' => 20,
                '51+' => 8,
            ],
            'education_distribution' => [
                'sd' => 15,
                'sltp' => 10,
                'slta' => 12,
                's1' => 8,
                's2' => 3,
                's3' => 1,
            ],
        ];
        
        return Inertia::render('dashboard', [
            'stats' => $stats,
            'user' => $user,
            'charts' => $charts,
        ]);
    }
}