<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'title'       => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:100'],
            'file_size'   => ['nullable', 'numeric'],
            'duration'    => ['nullable', 'string'],
            'resolution'  => ['nullable', 'string', 'max:100'],
            'format'      => ['nullable', 'string', 'max:100'],
            'video'       => ['required', 'file', 'mimetypes:video/mp4,video/x-m4v,video/*'],
        ];
    }
}
