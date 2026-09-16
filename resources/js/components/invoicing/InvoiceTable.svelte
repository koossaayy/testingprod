<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import { _ } from 'svelte-i18n';
    import StatusBadge from '@/components/invoicing/StatusBadge.svelte';
    import { toUrl } from '@/lib/utils';
    import { show } from '@/routes/invoices';
    import type { InvoiceRow } from '@/types';

    let {
        invoices,
        showClientColumn = true,
    }: {
        invoices: InvoiceRow[];
        showClientColumn?: boolean;
    } = $props();

    /** Turn the remaining days into the phrase we show under the due date. */
    function dueHint(invoice: InvoiceRow): string {
        if (invoice.status === 'paid') {
            return $_('Settled in full');
        }

        if (invoice.days_until_due === 0) {
            return $_('Due today');
        }

        if (invoice.days_until_due < 0) {
            const days = Math.abs(invoice.days_until_due);

            return $_('{0} {1} overdue', { values: { 0: days, 1: days === 1 ? $_('day') : $_('days') } });
        }

        return $_('Due in {0} {1}', { values: { 0: invoice.days_until_due, 1: invoice.days_until_due === 1 ? $_('day') : $_('days') } });
    }
</script>

<div class="overflow-x-auto rounded-xl border">
    <table class="w-full text-left text-sm">
        <caption class="sr-only">
            {$_('Every invoice you have raised, with its client, status and amount.')}
        </caption>
        <thead class="border-b bg-muted/50 text-xs text-muted-foreground uppercase">
            <tr>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Invoice')}</th>
                {#if showClientColumn}
                    <th scope="col" class="px-4 py-3 font-medium">{$_('Client')}</th>
                {/if}
                <th scope="col" class="px-4 py-3 font-medium">{$_('Status')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Issued')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Due date')}</th>
                <th scope="col" class="px-4 py-3 text-right font-medium">{$_('Amount')}</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            {#each invoices as invoice (invoice.id)}
                <tr class="hover:bg-muted/40">
                    <td class="px-4 py-3 font-medium">
                        <Link
                            href={toUrl(show(invoice.id))}
                            class="underline-offset-4 hover:underline"
                            title={$_('Open invoice {0}', { values: { 0: invoice.number } })}
                        >
                            {invoice.number}
                        </Link>
                    </td>
                    {#if showClientColumn}
                        <td class="px-4 py-3 text-muted-foreground">
                            {invoice.client_name}
                        </td>
                    {/if}
                    <td class="px-4 py-3">
                        <StatusBadge status={invoice.status} />
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">
                        {invoice.issued_on}
                    </td>
                    <td class="px-4 py-3">
                        <span class="block">{invoice.due_on}</span>
                        <span
                            class={invoice.is_overdue
                                ? 'text-xs text-destructive'
                                : 'text-xs text-muted-foreground'}
                        >
                            {dueHint(invoice)}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right font-medium tabular-nums">
                        {invoice.total}
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>
