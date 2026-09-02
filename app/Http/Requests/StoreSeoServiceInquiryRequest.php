<?php

namespace App\Http\Requests;

use App\Rules\Recaptcha;
use App\Support\Countries;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSeoServiceInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('name')) {
            $first = trim((string) $this->input('firstName', $this->input('first_name', '')));
            $last = trim((string) $this->input('lastName', $this->input('last_name', '')));
            if ($first !== '' || $last !== '') {
                $this->merge(['name' => trim($first.' '.$last)]);
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page_type' => ['required', Rule::in(['on_page', 'off_page'])],
            'service_name' => ['nullable', 'string', 'max:190'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'country' => ['required', 'string', Rule::in(Countries::names())],
            'company' => ['nullable', 'string', 'max:190'],
            'website' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'max:5000'],
            'fax_number' => ['nullable', 'string', 'max:100'],
            'redirect_to' => ['nullable', 'string', 'max:500'],
            'g-recaptcha-response' => ['required', new Recaptcha],
        ];
    }
}
