<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prices' => 'required|array',
            'prices.*.guid' => 'required|string',
            // TODO: можно брать лимиты из конфигурации
            'prices.*.price' => 'required|decimal:2|min:1|max:500000',
        ];
    }
}
