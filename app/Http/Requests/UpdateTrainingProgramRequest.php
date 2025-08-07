<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingProgramRequest extends FormRequest
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
            'program_code' => 'required|string|max:255|unique:training_programs,program_code,' . $this->route('training_program')->id,
            'program_name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'certification' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
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
            'program_code.required' => 'Kode program wajib diisi.',
            'program_code.unique' => 'Kode program sudah digunakan.',
            'program_name.required' => 'Nama program wajib diisi.',
            'description.required' => 'Deskripsi program wajib diisi.',
            'duration_days.required' => 'Durasi pelatihan wajib diisi.',
            'duration_days.min' => 'Durasi pelatihan minimal 1 hari.',
            'cost.required' => 'Biaya pelatihan wajib diisi.',
            'cost.min' => 'Biaya pelatihan tidak boleh negatif.',
        ];
    }
}