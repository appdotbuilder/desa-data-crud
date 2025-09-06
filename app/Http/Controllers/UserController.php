<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat data user.');
        }

        $users = User::paginate(10);

        return Inertia::render('users/index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menambah user.');
        }

        return Inertia::render('users/create', [
            'kabupatens' => Kabupaten::with('kecamatans.desas')->get(),
            'roles' => [
                'admin_kabupaten' => 'Admin Kabupaten',
                'admin_kecamatan' => 'Admin Kecamatan',
                'admin_desa' => 'Admin Desa',
            ]
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menambah user.');
        }

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        
        $newUser = User::create($data);

        return redirect()->route('users.show', $newUser)
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat detail user.');
        }

        return Inertia::render('users/show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit user.');
        }

        return Inertia::render('users/edit', [
            'user' => $user,
            'kabupatens' => Kabupaten::with('kecamatans.desas')->get(),
            'roles' => [
                'admin_kabupaten' => 'Admin Kabupaten',
                'admin_kecamatan' => 'Admin Kecamatan',
                'admin_desa' => 'Admin Desa',
            ]
        ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit user.');
        }

        $data = $request->validated();
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->update($data);

        return redirect()->route('users.show', $user)
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus user.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}