<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nim'          => ['required', 'string', 'max:20', 'unique:students,nim'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'prodi'        => ['required', 'string', 'max:100'],
            'angkatan'     => ['required', 'integer', 'digits:4', 'min:2000', 'max:2030'],
            'email'        => ['required', 'email', 'max:150', 'unique:students,email'],
            'alamat'       => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nim.required'          => 'NIM wajib diisi.',
            'nim.unique'            => 'NIM sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'prodi.required'        => 'Program studi wajib diisi.',
            'angkatan.required'     => 'Tahun angkatan wajib diisi.',
            'angkatan.digits'       => 'Angkatan harus 4 digit tahun (contoh: 2025).',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah digunakan mahasiswa lain.',
        ];
    }
}