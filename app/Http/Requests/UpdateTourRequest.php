<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'categoria_id' => ['required', 'exists:categorias,id'],
            'guia_id' => ['nullable', 'exists:users,id'],

            'titulo' =>['required', 'string', 'max:255'],
            'descripcion'=>['required', 'string'],

            'precio'=> ['required', 'numeric', 'min:0.01'],
            'duracion_horas' => ['required', 'integer', 'min:1'],
            'cupo_maximo'=>['required', 'integer', 'min:1'],

            'fecha_salida' => ['required', 'date', 'after:now'],

            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'servicios'=>['required', 'array', 'min:1'],
            'servicios.*'=>['exists:servicios,id'],

            'activo' => ['required', 'boolean'],
        ];
    }
}
