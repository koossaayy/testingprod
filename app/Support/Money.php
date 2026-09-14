<?php

namespace App\Support;

use NumberFormatter;

class Money
{
    /**
     * Format an amount stored in minor units as a display string.
     */
    public static function format(int $cents, string $currency = 'USD'): string
    {
        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($cents / 100, $currency) ?: number_format($cents / 100, 2);
    }
}
