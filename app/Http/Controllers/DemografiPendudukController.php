<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemografiPendudukRequest;
use App\Http\Requests\UpdateDemografiPendudukRequest;
use App\Models\DemografiPenduduk;
use App\Models\Desa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DemografiPendudukController extends Controller
{
    /**
     * Display a listing of demographic data.
     */
    public function index()
    {
        $user = auth()->user();
        $query = DemografiPenduduk::with('desa.kecamatan.kabupaten');
        
        // Apply role-based filtering
        $query = $this->applyRoleFilter($query, $user);
        
        $demografi = $query->paginate(15);

        return Inertia::render('demografi/index', [
            'demografi' => $demografi,
            'can_create' => $user->isAdminDesa() || $user->isSuperAdmin(),
        ]);
    }

    /**
     * Show the form for creating new demographic data.
     */
    public function create()
    {
        $user = auth()->user();
        
        if (!$user->isAdminDesa() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menambah data demografi.');
        }

        $desas = $this->getAccessibleDesas($user);

        return Inertia::render('demografi/create', [
            'desas' => $desas,
            'jenis_kelamin_options' => [
                'laki-laki' => 'Laki-laki',
                'perempuan' => 'Perempuan',
            ],
            'pendidikan_options' => [
                'sd' => 'SD',
                'sltp' => 'SLTP',
                'slta' => 'SLTA',
                's1' => 'S1',
                's2' => 'S2',
                's3' => 'S3',
            ],
            'agama_options' => [
                'islam' => 'Islam',
                'katolik' => 'Katolik',
                'protestan' => 'Protestan',
                'hindu' => 'Hindu',
                'budha' => 'Budha',
                'konghucu' => 'Konghucu',
                'kepercayaan' => 'Kepercayaan',
            ],
        ]);
    }

    /**
     * Store newly created demographic data.
     */
    public function store(StoreDemografiPendudukRequest $request)
    {
        $user = auth()->user();
        
        if (!$user->isAdminDesa() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menambah data demografi.');
        }

        $demografi = DemografiPenduduk::create($request->validated());

        return redirect()->route('demografi.show', $demografi)
            ->with('success', 'Data demografi berhasil ditambahkan.');
    }

    /**
     * Display the specified demographic data.
     */
    public function show(DemografiPenduduk $demografi)
    {
        $user = auth()->user();
        $this->authorizeAccess($demografi, $user);

        $demografi->load('desa.kecamatan.kabupaten');

        return Inertia::render('demografi/show', [
            'demografi' => $demografi,
            'can_edit' => $user->isAdminDesa() || $user->isSuperAdmin(),
        ]);
    }

    /**
     * Show the form for editing demographic data.
     */
    public function edit(DemografiPenduduk $demografi)
    {
        $user = auth()->user();
        
        if (!$user->isAdminDesa() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data demografi.');
        }

        $this->authorizeAccess($demografi, $user);
        $demografi->load('desa');

        $desas = $this->getAccessibleDesas($user);

        return Inertia::render('demografi/edit', [
            'demografi' => $demografi,
            'desas' => $desas,
            'jenis_kelamin_options' => [
                'laki-laki' => 'Laki-laki',
                'perempuan' => 'Perempuan',
            ],
            'pendidikan_options' => [
                'sd' => 'SD',
                'sltp' => 'SLTP',
                'slta' => 'SLTA',
                's1' => 'S1',
                's2' => 'S2',
                's3' => 'S3',
            ],
            'agama_options' => [
                'islam' => 'Islam',
                'katolik' => 'Katolik',
                'protestan' => 'Protestan',
                'hindu' => 'Hindu',
                'budha' => 'Budha',
                'konghucu' => 'Konghucu',
                'kepercayaan' => 'Kepercayaan',
            ],
        ]);
    }

    /**
     * Update the specified demographic data.
     */
    public function update(UpdateDemografiPendudukRequest $request, DemografiPenduduk $demografi)
    {
        $user = auth()->user();
        
        if (!$user->isAdminDesa() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data demografi.');
        }

        $this->authorizeAccess($demografi, $user);

        $demografi->update($request->validated());

        return redirect()->route('demografi.show', $demografi)
            ->with('success', 'Data demografi berhasil diperbarui.');
    }

    /**
     * Remove the specified demographic data.
     */
    public function destroy(DemografiPenduduk $demografi)
    {
        $user = auth()->user();
        
        if (!$user->isAdminDesa() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data demografi.');
        }

        $this->authorizeAccess($demografi, $user);

        $demografi->delete();

        return redirect()->route('demografi.index')
            ->with('success', 'Data demografi berhasil dihapus.');
    }

    /**
     * Apply role-based filter to query.
     */
    protected function applyRoleFilter($query, $user)
    {
        if ($user->isSuperAdmin()) {
            return $query;
        } elseif ($user->isAdminKabupaten()) {
            return $query->whereHas('desa.kecamatan.kabupaten', function($q) use ($user) {
                $q->where('nama', $user->kabupaten);
            });
        } elseif ($user->isAdminKecamatan()) {
            return $query->whereHas('desa.kecamatan', function($q) use ($user) {
                $q->where('nama', $user->kecamatan)
                  ->whereHas('kabupaten', function($subQ) use ($user) {
                      $subQ->where('nama', $user->kabupaten);
                  });
            });
        } else { // Admin Desa
            return $query->whereHas('desa', function($q) use ($user) {
                $q->where('nama', $user->desa)
                  ->whereHas('kecamatan', function($subQ) use ($user) {
                      $subQ->where('nama', $user->kecamatan)
                           ->whereHas('kabupaten', function($subSubQ) use ($user) {
                               $subSubQ->where('nama', $user->kabupaten);
                           });
                  });
            });
        }
    }

    /**
     * Get accessible desas based on user role.
     */
    protected function getAccessibleDesas($user)
    {
        if ($user->isSuperAdmin()) {
            return Desa::with('kecamatan.kabupaten')->get();
        } elseif ($user->isAdminDesa()) {
            return Desa::with('kecamatan.kabupaten')
                ->where('nama', $user->desa)
                ->whereHas('kecamatan', function($q) use ($user) {
                    $q->where('nama', $user->kecamatan)
                      ->whereHas('kabupaten', function($subQ) use ($user) {
                          $subQ->where('nama', $user->kabupaten);
                      });
                })->get();
        }

        return collect();
    }

    /**
     * Check if user has access to demographic data.
     */
    protected function authorizeAccess(DemografiPenduduk $demografi, $user)
    {
        if ($user->isSuperAdmin()) {
            return;
        }

        $desa = $demografi->desa;
        
        if ($user->isAdminKabupaten()) {
            if ($desa->kecamatan->kabupaten->nama !== $user->kabupaten) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }
        } elseif ($user->isAdminKecamatan()) {
            if ($desa->kecamatan->nama !== $user->kecamatan || 
                $desa->kecamatan->kabupaten->nama !== $user->kabupaten) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }
        } else { // Admin Desa
            if ($desa->nama !== $user->desa || 
                $desa->kecamatan->nama !== $user->kecamatan || 
                $desa->kecamatan->kabupaten->nama !== $user->kabupaten) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }
        }
    }
}