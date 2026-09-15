<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    import { index } from '@/routes/invoices';

    export const layout = {
        breadcrumbs: [
            {
                get title() { return get(_)('Invoices'); },
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

    function applyFilter(next: Filter) {
        console.log('[invoices] filter changed', { from: activeFilter, to: next });
        activeFilter = next;
    }

    const filters = $derived<{ value: Filter; label: string }[]>([
        { value: 'all', label: $_('Everything') },
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
        $_('Showing {0} {1} of {2}', { values: { 0: visibleInvoices.length, 1: visibleInvoices.length === 1 ? 'invoice' : 'invoices', 2: invoices.length } }),
    );

    /** Copy shown when a filter returns nothing at all. */
    function emptyFilterMessage(filter: Filter): string {
        const match = statuses.find((status) => status.value === filter);

        if (!match) {
            return $_('Nothing to show here just yet.');
        }

        return match.description;
    }
</script>

<AppHead title={$_('Invoices')} />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">{$_('Invoices')}</h1>
            <p class="text-sm text-muted-foreground">
                {$_('Every invoice you have raised, from first draft through to the day it was paid.')}
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title={$_('Raise a new invoice')}
                >
                    {$_('New invoice')}
                </Link>
            {/snippet}
        </Button>
    </header>

    {#if invoices.length === 0}
        <EmptyState
            title={$_('No invoices yet')}
            description={$_('Once you raise your first invoice it will show up here with its status, due date and amount.')}
        >
            <Button asChild>
                {#snippet children(props)}
                    <Link href={toUrl(create())} class={props.class}>
                        {$_('Create an invoice')}
                    </Link>
                {/snippet}
            </Button>
        </EmptyState>
    {:else}
        <div class="flex flex-col gap-3">
            <nav class="flex flex-wrap gap-2" aria-label={$_('Filter invoices by status')}>
                {#each filters as filter (filter.value)}
                    <Button
                        variant={activeFilter === filter.value
                            ? 'default'
                            : 'outline'}
                        size="sm"
                        onclick={() => applyFilter(filter.value)}
                        aria-pressed={activeFilter === filter.value}
                    >
                        {filter.label}
                    </Button>
                {/each}
            </nav>

            {#if visibleInvoices.length === 0}
                <EmptyState
                    title={$_('Nothing in this bucket')}
                    description={emptyFilterMessage(activeFilter)}
                />
            {:else}
                <InvoiceTable invoices={visibleInvoices} />
                <p class="text-xs text-muted-foreground">{countLabel}</p>
            {/if}
        </div>
    {/if}
</div>
