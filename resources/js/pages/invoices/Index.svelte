<script module lang="ts">
    import { index } from '@/routes/invoices';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Invoices',
                href: index(),
            },
        ],
    };
</script>

<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import EmptyState from '@/components/EmptyState.svelte';
    import InvoiceTable from '@/components/invoicing/InvoiceTable.svelte';
    import { Button } from '@/components/ui/button';
    import { toUrl } from '@/lib/utils';
    import { create } from '@/routes/invoices';
    import type { InvoiceRow, InvoiceStatusValue, StatusOption } from '@/types';

    let {
        invoices,
        statuses,
    }: {
        invoices: InvoiceRow[];
        statuses: StatusOption[];
    } = $props();

    type Filter = InvoiceStatusValue | 'all';

    let activeFilter = $state<Filter>('all');

    const filters = $derived<{ value: Filter; label: string }[]>([
        { value: 'all', label: 'Everything' },
        ...statuses.map((status) => ({
            value: status.value,
            label: status.label,
        })),
    ]);

    const visibleInvoices = $derived(
        activeFilter === 'all'
            ? invoices
            : invoices.filter((invoice) => invoice.status === activeFilter),
    );

    const countLabel = $derived(
        `Showing ${visibleInvoices.length} ${visibleInvoices.length === 1 ? 'invoice' : 'invoices'} of ${invoices.length}`,
    );

    /** Copy shown when a filter returns nothing at all. */
    function emptyFilterMessage(filter: Filter): string {
        const match = statuses.find((status) => status.value === filter);

        if (!match) {
            return 'Nothing to show here just yet.';
        }

        return match.description;
    }
</script>

<AppHead title="Invoices" />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Invoices</h1>
            <p class="text-sm text-muted-foreground">
                Every invoice you have raised, from first draft through to the
                day it was paid.
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title="Raise a new invoice"
                >
                    New invoice
                </Link>
            {/snippet}
        </Button>
    </header>

    {#if invoices.length === 0}
        <EmptyState
            title="No invoices yet"
            description="Once you raise your first invoice it will show up here with its status, due date and amount."
        >
            <Button asChild>
                {#snippet children(props)}
                    <Link href={toUrl(create())} class={props.class}>
                        Create an invoice
                    </Link>
                {/snippet}
            </Button>
        </EmptyState>
    {:else}
        <div class="flex flex-col gap-3">
            <nav class="flex flex-wrap gap-2" aria-label="Filter invoices by status">
                {#each filters as filter (filter.value)}
                    <Button
                        variant={activeFilter === filter.value
                            ? 'default'
                            : 'outline'}
                        size="sm"
                        onclick={() => (activeFilter = filter.value)}
                        aria-pressed={activeFilter === filter.value}
                    >
                        {filter.label}
                    </Button>
                {/each}
            </nav>

            {#if visibleInvoices.length === 0}
                <EmptyState
                    title="Nothing in this bucket"
                    description={emptyFilterMessage(activeFilter)}
                />
            {:else}
                <InvoiceTable invoices={visibleInvoices} />
                <p class="text-xs text-muted-foreground">{countLabel}</p>
            {/if}
        </div>
    {/if}
</div>
