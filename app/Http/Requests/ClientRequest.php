<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'contact_name' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'company_number' => ['nullable', 'string', 'max:40'],
            'billing_address' => ['nullable', 'string', 'max:500'],
            'currency' => ['required', 'string', 'size:3'],
            'payment_terms_days' => ['required', 'integer', 'min:0', 'max:180'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'is_archived' => ['boolean'],
        ];
    }

    /**
     * Get the messages shown when validation fails.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Give this client a name so you can find them later.',
            'name.max' => 'Client names need to be shorter than 120 characters.',
            'email.required' => 'We need an email address to send invoices to.',
            'email.email' => 'That email address does not look quite right.',
            'currency.size' => 'Use a three letter currency code such as USD or EUR.',
            'payment_terms_days.required' => 'Tell us how many days this client has to pay.',
            'payment_terms_days.max' => 'Payment terms longer than 180 days are not supported.',
            'billing_address.max' => 'The billing address is too long to fit on an invoice.',
            'notes.max' => 'Keep your notes under 2000 characters.',
        ];
    }

    /**
     * Get the friendly field names used inside validation messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'contact_name' => 'contact person',
            'company_number' => 'company registration number',
            'payment_terms_days' => 'payment terms',
        ];
    }
}
