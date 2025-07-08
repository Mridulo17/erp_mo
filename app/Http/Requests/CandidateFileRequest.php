<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateFileRequest extends FormRequest
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
            'file_type' => 'required',
            'file_path' => 'required|file',
        ];
    }

    public function messages(): array
    {
        return [
            'file_type.required' => 'File type is required.',
            'file_path.required' => 'File is required.',
            'file_path.file'     => 'Uploaded file must be a valid file.',
        ];
    }
}
