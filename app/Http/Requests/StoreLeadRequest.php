<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    /**
     * Endpoint publik untuk pengiriman brief konsultasi.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi payload lead.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'brand_name' => ['nullable', 'string', 'max:150'],
            'package_id' => ['nullable', 'integer', 'exists:packages,id'],
            'addon_ids' => ['nullable', 'array'],
            'addon_ids.*' => ['integer', 'exists:addons,id'],
            'lang' => ['required', 'string', 'in:id,en'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'string', 'max:255'],
            'promo_code' => ['nullable', 'string', 'max:50'], // Honeypot anti-bot
        ];
    }
}