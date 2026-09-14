<?php

namespace App\Http\Requests\Settings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoicingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'business_name' => ['required', 'string', 'max:120'],
            'invoice_prefix' => ['required', 'string', 'max:10'],
            'default_payment_terms_days' => ['required', 'integer', 'min:0', 'max:180'],
            'default_tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'payment_instructions' => ['nullable', 'string', 'max:1000'],
            'send_payment_reminders' => ['boolean'],
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
            'business_name.required' => 'Your business name appears at the top of every invoice.',
            'invoice_prefix.required' => 'Choose a short prefix such as INV for your invoice numbers.',
            'invoice_prefix.max' => 'Keep the prefix to ten characters or fewer.',
            'default_payment_terms_days.required' => 'Set the default number of days clients have to pay.',
            'default_tax_rate.max' => 'A default tax rate above 100 percent is not allowed.',
            'payment_instructions.max' => 'Payment instructions have to fit in 1000 characters.',
        ];
    }
}
