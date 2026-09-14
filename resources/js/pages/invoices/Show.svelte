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
        linkCopied: 'Payment link copied. Paste it straight into an email.',
        linkFailed: 'Your browser blocked the copy. Select the link and copy it by hand.',
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
                    Invoice {invoice.number}
                </h1>
                <StatusBadge status={invoice.status} />
            </div>
            {#if invoice.status === 'paid'}
                <p class="text-sm text-muted-foreground">
                    Paid with <strong>{invoice.payment_method ?? 'bank transfer'}</strong>
                    on {invoice.paid_on}.
                </p>
            {:else}
                <p class="text-sm text-muted-foreground">
                    Invoice {invoice.number} is due on {invoice.due_on}.
                    {STATUS_HINTS[invoice.status]}
                </p>
            {/if}
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <Button
                variant="outline"
                size="sm"
                onclick={copyPaymentLink}
                title="Copy the public payment link for this invoice"
            >
                <Copy class="mr-2 size-4" />
                Copy payment link
            </Button>

            {#if invoice.status !== 'paid'}
                <Button variant="outline" size="sm" asChild>
                    {#snippet children(props)}
                        <Link href={toUrl(edit(invoice.id))} class={props.class}>
                            Edit invoice
                        </Link>
                    {/snippet}
                </Button>
            {/if}

            {#if invoice.status === 'draft'}
                <Button size="sm" onclick={sendInvoice}>
                    Send to client
                </Button>
                <Button
                    variant="ghost"
                    size="sm"
                    onclick={() => (confirmingDelete = true)}
                >
                    Delete draft
                </Button>
            {:else if invoice.status !== 'paid'}
                <Button size="sm" onclick={markAsPaid}>Mark as paid</Button>
            {/if}
        </div>
    </header>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="space-y-4 lg:col-span-2">
            <div class="rounded-xl border">
                <div class="flex items-center justify-between border-b px-4 py-3">
                    <h2 class="text-sm font-semibold">What you billed</h2>
                    <span class="text-xs text-muted-foreground">
                        {lineCountLabel}
                    </span>
                </div>
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">
                        The work included on invoice {invoice.number}.
                    </caption>
                    <thead
                        class="border-b bg-muted/50 text-xs text-muted-foreground uppercase"
                    >
                        <tr>
                            <th scope="col" class="px-4 py-2 font-medium">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                Quantity
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                Rate
                            </th>
                            <th scope="col" class="px-4 py-2 text-right font-medium">
                                Line total
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
                    <h2 class="text-sm font-semibold">Note to the client</h2>
                    <p class="mt-1 text-sm text-muted-foreground">
                        {invoice.notes}
                    </p>
                </div>
            {/if}
        </section>

        <aside class="space-y-4">
            <div class="rounded-xl border p-4">
                <h2 class="text-sm font-semibold">Billed to</h2>
                <p class="mt-2 text-sm font-medium">{invoice.client.name}</p>
                {#if invoice.client.contact_name}
                    <p class="text-sm text-muted-foreground">
                        Attention: {invoice.client.contact_name}
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
                <h2 class="text-sm font-semibold">Totals</h2>
                <dl class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">Subtotal</dt>
                        <dd class="tabular-nums">{invoice.subtotal}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-muted-foreground">
                            Tax at {invoice.tax_rate}%
                        </dt>
                        <dd class="tabular-nums">{invoice.tax}</dd>
                    </div>
                    <Separator />
                    <div class="flex justify-between font-semibold">
                        <dt>Total due</dt>
                        <dd class="tabular-nums">{invoice.total}</dd>
                    </div>
                </dl>
                <p class="mt-3 text-xs text-muted-foreground">
                    Issued on {invoice.issued_on}. Terms &amp; conditions from your
                    client agreement still apply.
                </p>
            </div>
        </aside>
    </div>
</div>

<ConfirmDialog
    open={confirmingDelete}
    title="Delete this draft?"
    description={`Draft ${invoice.number} will be removed for good. Nobody has seen it yet, so there is nothing to explain.`}
    confirmLabel="Delete draft"
    cancelLabel="Keep working on it"
    onConfirm={deleteInvoice}
    onCancel={() => (confirmingDelete = false)}
/>
