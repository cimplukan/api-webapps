<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InventarisPerawatanCreateRequest extends FormRequest
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
            "noinventaris" => "required|string|max:20",
            "petugas" => "required|string|max:20",
            "tanggal" => "required|date_format:Y-m-d",
            "kondisi" => "required|in:Baik,Rusak",
            "status" => "required|in:Ada,Tiada",
            "keterangan" => "nullable|string|max:11",
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ], 400));
    }
}
