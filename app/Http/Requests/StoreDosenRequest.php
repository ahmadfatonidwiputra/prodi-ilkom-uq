<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDosenRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255'],
            'nidn' => ['required', 'string', 'max:50', 'unique:dosens,nidn'],
            'jabatan' => ['required', 'string', 'max:255'],
            'jabatan_fungsional' => ['required', 'string', Rule::in(['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'])],
            'bidang_keahlian' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
