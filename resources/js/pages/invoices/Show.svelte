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
    import { Link, router } from '@inertiajs/svelte';
    import Copy from '@lucide/svelte/icons/copy';
    import { toast } from 'svelte-sonner';
    import AppHead from '@/components/AppHead.svelte';
    import ConfirmDialog from '@/components/ConfirmDialog.svelte';
    import StatusBadge, {
        STATUS_HINTS,
    } from '@/components/invoicing/StatusBadge.svelte';
    import { Button } from '@/components/ui/button';
    import { Separator } from '@/components/ui/separator';
    import { toUrl } from '@/lib/utils';
    import { destroy, edit, markPaid, send } from '@/routes/invoices';
    import type { InvoiceDetail } from '@/types';

    let {
        invoice,
    }: {
        invoice: InvoiceDetail;
    } = $props();

    let confirmingDelete = $state(false);

    /** Toast copy keyed by the action the freelancer just took. */
    const ACTION_TOASTS = {
        linkCopied: $_('Payment link copied. Paste it straight into an email.'),
        linkFailed: $_('Your browser blocked the copy. Select the link and copy it by hand.'),
    };

    const lineCountLabel = $derived(
        `${invoice.items.length} ${invoice.items.length === 1 ? 'line item' : 'line items'}`,
    );

    async function copyPaymentLink() {
        try {
            await navigator.clipboard.writeText(invoice.public_url);
            toast.success(ACTION_TOASTS.linkCopied);
        } catch (error) {
            console.error('clipboard write failed', error);
            toast.error(ACTION_TOASTS.linkFailed);
        }
    }

    function sendInvoice() {
        router.post(toUrl(send(invoice.id)), {}, { preserveScroll: true });
    }

    function markAsPaid() {
        router.post(
            toUrl(markPaid(invoice.id)),
            { payment_method: 'bank transfer' },
            { preserveScroll: true },
        );
    }

    function deleteInvoice() {
        confirmingDelete = false;
        router.delete(toUrl(destroy(invoice.id)));
    }
</script>

<AppHead title={`Invoice ${invoice.number}`} />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header class="flex flex-wrap items-start justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-semibold tracking-tight">
                    {$_('Invoice {0}', { values: { 0: invoice.number } })}
                </h1>
                <StatusBadge status={invoice.status} />
            </div>
            {#if invoice.status === 'paid'}
                <p class="text-sm text-muted-foreground">
                    {@html $_('Paid with {el0} on {v0}.', { values: { el0: `<strong>${invoice.payment_method ?? 'bank transfer'}</strong>`, v0: invoice.paid_on } })}
                </p>
            {:else}
                <p class="text-sm text-muted-foreground">
                    {$_('Invoice {0} is due on {1}. {2}', { values: { 0: invoice.number, 1: invoice.due_on, 2: STATUS_HINTS[invoice.status] } })}
                </p>
            {/if}
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <Button
                variant="outline"
                size="sm"
                onclick={copyPaymentLink}
                title={$_('Copy the public payment link for this invoice')}
            >
                <Copy class="mr-2 size-4" />
                {$_('Copy payment link')}
            </Button>

            {#if invoice.status !== 'paid'}
                <Button variant="outline" size="sm" asChild>
                    {#snippet children(props)}
                        <Link href={toUrl(edit(invoice.id))} class={props.class}>
                            {$_('Edit invoice')}
                        </Link>
                    {/snippet}
                </Button>
            {/if}

            {#if invoice.status === 'draft'}
                <Button size="sm" onclick={sendInvoice}>
                    {$_('Send to client')}
                </Button>
                <Button
                    variant="ghost"
                    size="sm"
                    onclick={() => (confirmingDelete = true)}
                >
                    {$_('Delete draft')}
                </Button>
            {:else if invoice.status !== 'paid'}
                <Button size="sm" onclick={markAsPaid}>{$_('Mark as paid')}</Button>
            {/if}
        </div>
    </header>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="space-y-4 lg:col-span-2">
            <div class="rounded-xl border">
                <div class="flex items-center justify-between border-b px-4 py-3">
                    <h2 class="text-sm font-semibold">{$_('What you billed')}</h2>
                    <span class="text-xs text-muted-foreground">
                        {lineCountLabel}
                    </span>
                </div>
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">
                        {$_('The work included on invoice {0}.', { values: { 0: invoice.number } })}
                    </caption>
                    <thead
                        class="border-b bg-muted/50 text-xs text-muted-foreground uppercase"
                    >
                        <tr>
                            <th scope="col" class="px-4 py-2 font-medium">
                                {$_('Description')}
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                {$_('Quantity')}
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                {$_('Rate')}
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                {$_('Line total')}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        {#each invoice.items as item (item.id)}
                            <tr>
                                <td class="px-4 py-3">{item.description}</td>
                                <td class="px-4 py-3 text-right tabular-nums">
                                    {item.quantity}
                                </td>
                                <td class="px-4 py-3 text-right tabular-nums">
                                    {item.unit_amount}
                                </td>
                                <td class="px-4 py-3 text-right font-medium tabular-nums">
                                    {item.line_total}
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>

            {#if invoice.notes}
                <div class="rounded-xl border p-4">
                    <h2 class="text-sm font-semibold">{$_('Note to the client')}</h2>
                    <p class="mt-1 text-sm text-muted-foreground">
                        {invoice.notes}
                    </p>
                </div>
            {/if}
        </section>

        <aside class="space-y-4">
            <div class="rounded-xl border p-4">
                <h2 class="text-sm font-semibold">{$_('Billed to')}</h2>
                <p class="mt-2 text-sm font-medium">{invoice.client.name}</p>
                {#if invoice.client.contact_name}
                    <p class="text-sm text-muted-foreground">
                        {$_('Attention: {0}', { values: { 0: invoice.client.contact_name } })}
                    </p>
                {/if}
                <p class="text-sm text-muted-foreground">
                    {invoice.client.email}
                </p>
                {#if invoice.client.billing_address}
                    <p class="mt-2 text-sm whitespace-pre-line text-muted-foreground">
                        {invoice.client.billing_address}
                    </p>
                {/if}
            </div>

            <div class="rounded-xl border p-4">
                <h2 class="text-sm font-semibold">{$_('Totals')}</h2>
                <dl class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">{$_('Subtotal')}</dt>
                        <dd class="tabular-nums">{invoice.subtotal}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">
                            {$_('Tax at {0}%', { values: { 0: invoice.tax_rate } })}
                        </dt>
                        <dd class="tabular-nums">{invoice.tax}</dd>
                    </div>
                    <Separator />
                    <div class="flex justify-between font-semibold">
                        <dt>{$_('Total due')}</dt>
                        <dd class="tabular-nums">{invoice.total}</dd>
                    </div>
                </dl>
                <p class="mt-3 text-xs text-muted-foreground">
                    {$_('Issued on {0}. Terms & conditions from your client agreement still apply.', { values: { 0: invoice.issued_on } })}
                </p>
            </div>
        </aside>
    </div>
</div>

<ConfirmDialog
    open={confirmingDelete}
    title={$_('Delete this draft?')}
    description={`Draft ${invoice.number} will be removed for good. Nobody has seen it yet, so there is nothing to explain.`}
    confirmLabel={$_('Delete draft')}
    cancelLabel={$_('Keep working on it')}
    onConfirm={deleteInvoice}
    onCancel={() => (confirmingDelete = false)}
/>
