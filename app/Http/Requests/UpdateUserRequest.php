<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin_kabupaten,admin_kecamatan,admin_desa',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'nullable|string|max:255|required_if:role,admin_kecamatan,admin_desa',
            'desa' => 'nullable|string|max:255|required_if:role,admin_desa',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Alamat email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar oleh user lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role harus dipilih.',
            'kabupaten.required' => 'Kabupaten harus diisi.',
            'kecamatan.required_if' => 'Kecamatan harus diisi untuk role ini.',
            'desa.required_if' => 'Desa harus diisi untuk Admin Desa.',
        ];
    }
}