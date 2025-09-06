<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemografiPendudukRequest extends FormRequest
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
            'desa_id' => 'required|exists:desas,id',
            'kk' => 'required|string|max:255',
            'nik' => 'required|string|unique:demografi_penduduk,nik|max:255',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => 'required|in:sd,sltp,slta,s1,s2,s3',
            'agama' => 'required|in:islam,katolik,protestan,hindu,budha,konghucu,kepercayaan',
            'pekerjaan' => 'required|string|max:255',
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
            'desa_id.required' => 'Desa harus dipilih.',
            'desa_id.exists' => 'Desa yang dipilih tidak valid.',
            'kk.required' => 'Nomor KK harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama lengkap harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'alamat.required' => 'Alamat harus diisi.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir harus dipilih.',
            'agama.required' => 'Agama harus dipilih.',
            'pekerjaan.required' => 'Pekerjaan harus diisi.',
        ];
    }
}