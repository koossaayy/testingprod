<script module lang="ts">
    import { dashboard } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Dashboard',
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
            return 'Good morning';
        }

        if (hour < 18) {
            return 'Good afternoon';
        }

        return 'Good evening';
    }

    const overdueHeadline = $derived(
        metrics.overdue_count === 1
            ? '1 invoice needs chasing'
            : `${metrics.overdue_count} invoices need chasing`,
    );
</script>

<AppHead title="Dashboard" />

<div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">
                {greeting()}, here is where your money stands
            </h1>
            <p class="text-sm text-muted-foreground">
                A quick read on what you are owed, what has landed, and who you
                need to nudge today.
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title="Start a new invoice from scratch"
                >
                    New invoice
                </Link>
            {/snippet}
        </Button>
    </header>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <MetricCard
            label="Outstanding"
            value={metrics.outstanding_total}
            hint="Sent and overdue invoices that have not been paid yet."
            icon={Wallet}
        />
        <MetricCard
            label="Paid this year"
            value={metrics.paid_this_year_total}
            hint="Everything that has actually landed in your account."
            icon={FileText}
        />
        <MetricCard
            label="Overdue invoices"
            value={metrics.overdue_count}
            hint="Past the due date and still waiting on payment."
            icon={CircleAlert}
        />
        <MetricCard
            label="Active clients"
            value={metrics.client_count}
            hint="Clients you can invoice right now."
            icon={Users}
        />
    </div>

    <section class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold">Needs your attention</h2>
            {#if metrics.overdue_count > 0}
                <span class="text-sm text-destructive">{overdueHeadline}</span>
            {/if}
        </div>

        {#if overdueInvoices.length === 0}
            <EmptyState
                title="Nothing is overdue"
                description="Every invoice you have sent is either paid or still within its payment terms. Enjoy the quiet."
            />
        {:else}
            <InvoiceTable invoices={overdueInvoices} />
            <p class="text-xs text-muted-foreground">
                Don&apos;t forget to send a short reminder before you escalate.
                Most late payments are simply an invoice sitting in the wrong
                inbox.
            </p>
        {/if}
    </section>

    <section class="flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold">Recent invoices</h2>
            <Button variant="link" size="sm" asChild>
                {#snippet children(props)}
                    <Link href={toUrl(invoiceIndex())} class={props.class}>
                        See all invoices
                    </Link>
                {/snippet}
            </Button>
        </div>

        {#if recentInvoices.length === 0}
            <EmptyState
                title="You have not raised an invoice yet"
                description="Add a client, then send your first invoice. It only takes a minute and you get paid sooner."
            >
                <Button asChild>
                    {#snippet children(props)}
                        <Link href={toUrl(create())} class={props.class}>
                            Create your first invoice
                        </Link>
                    {/snippet}
                </Button>
            </EmptyState>
        {:else}
            <InvoiceTable invoices={recentInvoices} />
        {/if}

        {#if metrics.draft_count > 0}
            <p class="text-xs text-muted-foreground">
                You have {metrics.draft_count}
                {metrics.draft_count === 1 ? 'draft' : 'drafts'} waiting to be sent.
                Drafts never get paid.
            </p>
        {/if}
    </section>
</div>
