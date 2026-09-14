<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case Draft = 'draft';
    case Sent = 'sent';
    case Paid = 'paid';
    case Overdue = 'overdue';
    case Cancelled = 'cancelled';

    /**
     * Get the human readable label shown next to the invoice.
     */
    public function label(): string
    {
        return match ($this) {
            self::Draft => __('Draft'),
            self::Sent => __('Awaiting payment'),
            self::Paid => __('Paid'),
            self::Overdue => __('Overdue'),
            self::Cancelled => __('Cancelled'),
        };
    }

    /**
     * Get the short sentence explaining what the status means.
     */
    public function description(): string
    {
        return match ($this) {
            self::Draft => __('Only you can see this invoice until you send it.'),
            self::Sent => __('The invoice has been emailed and is waiting to be paid.'),
            self::Paid => __('Payment has been received in full. Nothing left to chase.'),
            self::Overdue => __('The due date has passed and no payment has arrived yet.'),
            self::Cancelled => __('This invoice was voided and will not be collected.'),
        };
    }

    /**
     * Get the badge colour token used by the front end.
     */
    public function badgeVariant(): string
    {
        return match ($this) {
            self::Draft => 'secondary',
            self::Sent => 'default',
            self::Paid => 'default',
            self::Overdue => 'destructive',
            self::Cancelled => 'outline',
        };
    }

    /**
     * Get every status as a select option for the invoice form.
     *
     * @return array<int, array{value: string, label: string, description: string}>
     */
    public static function options(): array
    {
        return array_map(fn (self $status): array => [
            'value' => $status->value,
            'label' => $status->label(),
            'description' => $status->description(),
        ], self::cases());
    }
}
