<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Support\Money;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the money overview for the signed in freelancer.
     */
    public function index(Request $request): Response
    {
        $invoices = $request->user()->invoices()->with('client', 'items')->get();

        $outstandingCents = $invoices
            ->whereIn('status', [InvoiceStatus::Sent, InvoiceStatus::Overdue])
            ->sum(fn (Invoice $invoice): int => $invoice->totalCents());

        $paidThisYearCents = $invoices
            ->where('status', InvoiceStatus::Paid)
            ->filter(fn (Invoice $invoice): bool => $invoice->paid_on?->isCurrentYear() ?? false)
            ->sum(fn (Invoice $invoice): int => $invoice->totalCents());

        $overdue = $invoices->filter(fn (Invoice $invoice): bool => $invoice->isOverdue());

        return Inertia::render('Dashboard', [
            'metrics' => [
                'outstanding_total' => Money::format((int) $outstandingCents),
                'paid_this_year_total' => Money::format((int) $paidThisYearCents),
                'overdue_count' => $overdue->count(),
                'client_count' => $request->user()->clients()->where('is_archived', false)->count(),
                'draft_count' => $invoices->where('status', InvoiceStatus::Draft)->count(),
            ],
            'overdueInvoices' => $overdue
                ->sortBy('due_on')
                ->values()
                ->map(fn (Invoice $invoice): array => $invoice->toRowArray())
                ->all(),
            'recentInvoices' => $invoices
                ->sortByDesc('issued_on')
                ->take(5)
                ->values()
                ->map(fn (Invoice $invoice): array => $invoice->toRowArray())
                ->all(),
        ]);
    }
}
