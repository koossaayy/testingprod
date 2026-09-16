<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    import { dashboard } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                get title() { return get(_)('Dashboard'); },
                href: dashboard(),
            },
        ],
    };
</script>

<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import CircleAlert from '@lucide/svelte/icons/circle-alert';
    import FileText from '@lucide/svelte/icons/file-text';
    import Users from '@lucide/svelte/icons/users';
    import Wallet from '@lucide/svelte/icons/wallet';
    import AppHead from '@/components/AppHead.svelte';
    import EmptyState from '@/components/EmptyState.svelte';
    import InvoiceTable from '@/components/invoicing/InvoiceTable.svelte';
    import MetricCard from '@/components/invoicing/MetricCard.svelte';
    import { Button } from '@/components/ui/button';
    import { toUrl } from '@/lib/utils';
    import { create, index as invoiceIndex } from '@/routes/invoices';
    import type { DashboardMetrics, InvoiceRow } from '@/types';

    let {
        metrics,
        overdueInvoices,
        recentInvoices,
    }: {
        metrics: DashboardMetrics;
        overdueInvoices: InvoiceRow[];
        recentInvoices: InvoiceRow[];
    } = $props();

    /** Greet the freelancer based on the time of day on their machine. */
    function greeting(): string {
        const hour = new Date().getHours();

        if (hour < 12) {
            return $_('Good morning');
        }

        if (hour < 18) {
            return $_('Good afternoon');
        }

        return $_('Good evening');
    }

    const overdueHeadline = $derived(
        metrics.overdue_count === 1
            ? '1 invoice needs chasing'
            : $_('{0} invoices need chasing', { values: { 0: metrics.overdue_count } }),
    );
</script>

<AppHead title={$_('Dashboard')} />

<div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">
                {$_('{0}, here is where your money stands', { values: { 0: greeting() } })}
            </h1>
            <p class="text-sm text-muted-foreground">
                {$_('A quick read on what you are owed, what has landed, and who you need to nudge today.')}
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title={$_('Start a new invoice from scratch')}
                >
                    {$_('New invoice')}
                </Link>
            {/snippet}
        </Button>
    </header>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <MetricCard
            label={$_('Outstanding')}
            value={metrics.outstanding_total}
            hint={$_('Sent and overdue invoices that have not been paid yet.')}
            icon={Wallet}
        />
        <MetricCard
            label={$_('Paid this year')}
            value={metrics.paid_this_year_total}
            hint={$_('Everything that has actually landed in your account.')}
            icon={FileText}
        />
        <MetricCard
            label={$_('Overdue invoices')}
            value={metrics.overdue_count}
            hint={$_('Past the due date and still waiting on payment.')}
            icon={CircleAlert}
        />
        <MetricCard
            label={$_('Active clients')}
            value={metrics.client_count}
            hint={$_('Clients you can invoice right now.')}
            icon={Users}
        />
    </div>

    <section class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold">{$_('Needs your attention')}</h2>
            {#if metrics.overdue_count > 0}
                <span class="text-sm text-destructive">{overdueHeadline}</span>
            {/if}
        </div>

        {#if overdueInvoices.length === 0}
            <EmptyState
                title={$_('Nothing is overdue')}
                description={$_('Every invoice you have sent is either paid or still within its payment terms. Enjoy the quiet.')}
            />
        {:else}
            <InvoiceTable invoices={overdueInvoices} />
            <p class="text-xs text-muted-foreground">
                {$_('Don\'t forget to send a short reminder before you escalate. Most late payments are simply an invoice sitting in the wrong inbox.')}
            </p>
        {/if}
    </section>

    <section class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold">{$_('Recent invoices')}</h2>
            <Button variant="link" size="sm" asChild>
                {#snippet children(props)}
                    <Link href={toUrl(invoiceIndex())} class={props.class}>
                        {$_('See all invoices')}
                    </Link>
                {/snippet}
            </Button>
        </div>

        {#if recentInvoices.length === 0}
            <EmptyState
                title={$_('You have not raised an invoice yet')}
                description={$_('Add a client, then send your first invoice. It only takes a minute and you get paid sooner.')}
            >
                <Button asChild>
                    {#snippet children(props)}
                        <Link href={toUrl(create())} class={props.class}>
                            {$_('Create your first invoice')}
                        </Link>
                    {/snippet}
                </Button>
            </EmptyState>
        {:else}
            <InvoiceTable invoices={recentInvoices} />
        {/if}

        {#if metrics.draft_count > 0}
            <p class="text-xs text-muted-foreground">
                {$_('You have {0} {1} waiting to be sent. Drafts never get paid.', { values: { 0: metrics.draft_count, 1: metrics.draft_count === 1 ? $_('draft') : $_('drafts') } })}
            </p>
        {/if}
    </section>
</div>
