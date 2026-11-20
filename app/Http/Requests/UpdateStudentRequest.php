<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student');

        return [
            'nim' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('students', 'nim')->ignore($studentId),
            ],
            'nama_lengkap' => ['sometimes', 'required', 'string', 'max:150'],
            'prodi'        => ['sometimes', 'required', 'string', 'max:100'],
            'angkatan'     => ['sometimes', 'required', 'integer', 'digits:4', 'min:2000', 'max:2030'],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:150',
                Rule::unique('students', 'email')->ignore($studentId),
            ],
            'alamat' => ['nullable', 'string'],
        ];
    }
}