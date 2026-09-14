<?php

namespace App\Http\Requests;

use App\Enums\InvoiceStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $invoiceId = $this->route('invoice')?->id;

        return [
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')->where('user_id', $this->user()->id),
            ],
            'number' => [
                'required',
                'string',
                'max:40',
                Rule::unique('invoices', 'number')->ignore($invoiceId),
            ],
            'status' => ['required', Rule::enum(InvoiceStatus::class)],
            'issued_on' => ['required', 'date'],
            'due_on' => ['required', 'date', 'after_or_equal:issued_on'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'currency' => ['required', 'string', 'size:3'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:200'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_amount' => ['required', 'numeric', 'min:0'],
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
            'client_id.required' => __('Choose which client this invoice is for.'),
            'client_id.exists' => __('That client is not on your list any more.'),
            'number.required' => __('Every invoice needs a number your client can quote.'),
            'number.unique' => __('You have already used that invoice number.'),
            'status.required' => __('Pick a status so you know where this invoice stands.'),
            'issued_on.required' => __('Tell us the date you issued this invoice.'),
            'due_on.after_or_equal' => __('The due date cannot fall before the issue date.'),
            'tax_rate.max' => __('A tax rate above 100 percent is not allowed.'),
            'items.required' => __('Add at least one line item before saving.'),
            'items.min' => __('Add at least one line item before saving.'),
            'items.*.description.required' => __('Describe the work on every line of the invoice.'),
            'items.*.quantity.min' => __('Quantities have to be greater than zero.'),
            'items.*.unit_amount.required' => __('Enter a rate for each line of the invoice.'),
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
            'client_id' => __('client'),
            'issued_on' => __('issue date'),
            'due_on' => __('due date'),
            'tax_rate' => __('tax rate'),
        ];
    }
}
