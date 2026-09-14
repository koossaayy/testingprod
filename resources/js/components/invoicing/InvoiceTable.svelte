<script lang="ts">
    import { Link } from '@inertiajs/svelte';
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
            return 'Settled in full';
        }

        if (invoice.days_until_due === 0) {
            return 'Due today';
        }

        if (invoice.days_until_due < 0) {
            const days = Math.abs(invoice.days_until_due);

            return `${days} ${days === 1 ? 'day' : 'days'} overdue`;
        }

        return `Due in ${invoice.days_until_due} ${invoice.days_until_due === 1 ? 'day' : 'days'}`;
    }
</script>

<div class="overflow-x-auto rounded-xl border">
    <table class="w-full text-left text-sm">
        <caption class="sr-only">
            Every invoice you have raised, with its client, status and amount.
        </caption>
        <thead class="border-b bg-muted/50 text-xs text-muted-foreground uppercase">
            <tr>
                <th scope="col" class="px-4 py-3 font-medium">Invoice</th>
                {#if showClientColumn}
                    <th scope="col" class="px-4 py-3 font-medium">Client</th>
                {/if}
                <th scope="col" class="px-4 py-3 font-medium">Status</th>
                <th scope="col" class="px-4 py-3 font-medium">Issued</th>
                <th scope="col" class="px-4 py-3 font-medium">Due date</th>
                <th scope="col" class="px-4 py-3 text-right font-medium">Amount</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            {#each invoices as invoice (invoice.id)}
                <tr class="hover:bg-muted/40">
                    <td class="px-4 py-3 font-medium">
                        <Link
                            href={toUrl(show(invoice.id))}
                            class="underline-offset-4 hover:underline"
                            title={`Open invoice ${invoice.number}`}
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
