<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Support\Money;
use Database\Factories\InvoiceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Invoice extends Model
{
    /** @use HasFactory<InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'number',
        'public_token',
        'status',
        'issued_on',
        'due_on',
        'paid_on',
        'payment_method',
        'tax_rate_basis_points',
        'currency',
        'notes',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $invoice): void {
            $invoice->public_token ??= Str::lower(Str::random(32));
        });
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasMany<InvoiceItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('position');
    }

    /**
     * Scope the query to invoices that are still waiting to be collected.
     *
     * @param  Builder<Invoice>  $query
     */
    public function scopeOutstanding(Builder $query): void
    {
        $query->whereIn('status', [InvoiceStatus::Sent->value, InvoiceStatus::Overdue->value]);
    }

    public function subtotalCents(): int
    {
        return $this->items->sum(fn (InvoiceItem $item): int => $item->lineTotalCents());
    }

    public function taxCents(): int
    {
        return (int) round($this->subtotalCents() * $this->tax_rate_basis_points / 10000);
    }

    public function totalCents(): int
    {
        return $this->subtotalCents() + $this->taxCents();
    }

    public function isOverdue(): bool
    {
        return $this->status !== InvoiceStatus::Paid
            && $this->status !== InvoiceStatus::Cancelled
            && $this->due_on->isPast();
    }

    public function daysUntilDue(): int
    {
        return (int) Carbon::today()->diffInDays($this->due_on, false);
    }

    /**
     * Build the payload shared with the invoice tables on the front end.
     *
     * @return array{id: int, number: string, status: string, status_label: string, status_variant: string, status_description: string, client_id: int, client_name: string, issued_on: string, due_on: string, paid_on: string|null, payment_method: string|null, total: string, is_overdue: bool, days_until_due: int}
     */
    public function toRowArray(): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'status' => $this->status->value,
            'status_label' => $this->status->label(),
            'status_variant' => $this->status->badgeVariant(),
            'status_description' => $this->status->description(),
            'client_id' => $this->client_id,
            'client_name' => $this->client->name,
            'issued_on' => $this->issued_on->format('M j, Y'),
            'due_on' => $this->due_on->format('M j, Y'),
            'paid_on' => $this->paid_on?->format('M j, Y'),
            'payment_method' => $this->payment_method,
            'total' => Money::format($this->totalCents(), $this->currency),
            'is_overdue' => $this->isOverdue(),
            'days_until_due' => $this->daysUntilDue(),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => InvoiceStatus::class,
            'issued_on' => 'date',
            'due_on' => 'date',
            'paid_on' => 'date',
            'tax_rate_basis_points' => 'integer',
        ];
    }
}
