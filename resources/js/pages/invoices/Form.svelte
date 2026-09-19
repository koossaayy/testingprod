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
    import { Link, useForm } from '@inertiajs/svelte';
    import Plus from '@lucide/svelte/icons/plus';
    import Trash2 from '@lucide/svelte/icons/trash-2';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { toUrl } from '@/lib/utils';
    import { store, update } from '@/routes/invoices';
    import type {
        ClientOption,
        InvoiceFormRecord,
        StatusOption,
    } from '@/types';

    let {
        invoice,
        clients,
        statuses,
        suggestedNumber,
    }: {
        invoice: InvoiceFormRecord | null;
        clients: ClientOption[];
        statuses: StatusOption[];
        suggestedNumber: string;
    } = $props();

    const isEditing = $derived(invoice !== null);

    /** Short nudges shown under the trickier fields on this form. */
    const FIELD_HINTS = {
        number: $_('Your client will quote this number when they pay, so keep it unique.'),
        dueDate: $_('Most freelancers give 14 days. Shorter terms get you paid faster.'),
        taxRate: $_('Leave this at zero if you are not registered for sales tax.'),
        notes: $_('A warm line here goes a long way. Thank them for the work.'),
    };

    const today = new Date().toISOString().slice(0, 10);

    const form = useForm(() => ({
        client_id: invoice?.client_id ?? clients[0]?.value ?? '',
        number: invoice?.number ?? suggestedNumber,
        status: invoice?.status ?? 'draft',
        issued_on: invoice?.issued_on ?? today,
        due_on: invoice?.due_on ?? today,
        tax_rate: invoice?.tax_rate ?? 0,
        currency: invoice?.currency ?? 'USD',
        notes: invoice?.notes ?? '',
        items: invoice?.items ?? [
            { description: '', quantity: 1, unit_amount: 0 },
        ],
    }));

    const pageTitle = $derived(isEditing ? $_('Edit invoice') : $_('New invoice'));

    const pageDescription = $derived(
        isEditing
            ? $_('Change anything you need to. The client only sees the invoice once you send it again.')
            : $_('List the work, set a due date, and send it when you are happy.'),
    );

    const subtotal = $derived(
        form.items.reduce(
            (total, item) =>
                total + Number(item.quantity || 0) * Number(item.unit_amount || 0),
            0,
        ),
    );

    const total = $derived(subtotal * (1 + Number(form.tax_rate || 0) / 100));

    const lineSummary = $derived(
        $_('{0, plural, one {# line} other {# lines}} adding up to {1} {2}', { values: { 0: form.items.length, 1: total.toFixed(2), 2: form.currency } }),
    );

    function addLine() {
        form.items = [
            ...form.items,
            { description: '', quantity: 1, unit_amount: 0 },
        ];
    }

    function removeLine(index: number) {
        form.items = form.items.filter((_, position) => position !== index);
    }

    function submit(event: SubmitEvent) {
        event.preventDefault();

        if (isEditing && invoice) {
            form.put(toUrl(update(invoice.id)));

            return;
        }

        form.post(toUrl(store()));
    }
</script>

<AppHead title={pageTitle} />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header>
        <h1 class="text-xl font-semibold tracking-tight">{pageTitle}</h1>
        <p class="text-sm text-muted-foreground">{pageDescription}</p>
    </header>

    {#if clients.length === 0}
        <div class="rounded-xl border border-dashed p-6 text-sm">
            <p class="font-medium">{$_('You need a client first')}</p>
            <p class="mt-1 text-muted-foreground">
                {$_('Add the company you are billing, then come back and raise the invoice.')}
            </p>
        </div>
    {:else}
        <form onsubmit={submit} class="max-w-3xl space-y-6">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="client_id">{$_('Client')}</Label>
                    <select
                        id="client_id"
                        bind:value={form.client_id}
                        class="h-9 rounded-md border border-input bg-background px-3 text-sm shadow-sm focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                    >
                        {#each clients as client (client.value)}
                            <option value={client.value}>{client.label}</option>
                        {/each}
                    </select>
                    <InputError message={form.errors.client_id} />
                </div>

                <div class="grid gap-2">
                    <Label for="number">{$_('Invoice number')}</Label>
                    <Input
                        id="number"
                        bind:value={form.number}
                        required
                        placeholder="INV-2026-001"
                    />
                    <p class="text-xs text-muted-foreground">
                        {FIELD_HINTS.number}
                    </p>
                    <InputError message={form.errors.number} />
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="grid gap-2">
                    <Label for="status">{$_('Status')}</Label>
                    <select
                        id="status"
                        bind:value={form.status}
                        class="h-9 rounded-md border border-input bg-background px-3 text-sm shadow-sm focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                    >
                        {#each statuses as status (status.value)}
                            <option value={status.value} title={status.description}>
                                {status.label}
                            </option>
                        {/each}
                    </select>
                    <InputError message={form.errors.status} />
                </div>

                <div class="grid gap-2">
                    <Label for="issued_on">{$_('Issue date')}</Label>
                    <Input id="issued_on" type="date" bind:value={form.issued_on} />
                    <InputError message={form.errors.issued_on} />
                </div>

                <div class="grid gap-2">
                    <Label for="due_on">{$_('Due date')}</Label>
                    <Input id="due_on" type="date" bind:value={form.due_on} />
                    <p class="text-xs text-muted-foreground">
                        {FIELD_HINTS.dueDate}
                    </p>
                    <InputError message={form.errors.due_on} />
                </div>
            </div>

            <fieldset class="space-y-3 rounded-xl border p-4">
                <legend class="px-1 text-sm font-semibold">{$_('Line items')}</legend>

                {#each form.items as item, position (position)}
                    <div class="grid gap-3 sm:grid-cols-[1fr_6rem_8rem_auto]">
                        <div class="grid gap-1">
                            <Label
                                for={`item-description-${position}`}
                                class="sr-only"
                            >
                                {$_('Description of the work')}
                            </Label>
                            <Input
                                id={`item-description-${position}`}
                                bind:value={item.description}
                                placeholder={$_('What did you do for them?')}
                            />
                            <InputError
                                message={form.errors[
                                    `items.${position}.description`
                                ]}
                            />
                        </div>

                        <div class="grid gap-1">
                            <Label for={`item-quantity-${position}`} class="sr-only">
                                {$_('Quantity or hours')}
                            </Label>
                            <Input
                                id={`item-quantity-${position}`}
                                type="number"
                                step="0.25"
                                min="0.25"
                                bind:value={item.quantity}
                                title={$_('Hours worked, or the number of units')}
                            />
                        </div>

                        <div class="grid gap-1">
                            <Label for={`item-rate-${position}`} class="sr-only">
                                {$_('Rate per unit')}
                            </Label>
                            <Input
                                id={`item-rate-${position}`}
                                type="number"
                                step="0.01"
                                min="0"
                                bind:value={item.unit_amount}
                                title={$_('Your rate for this line')}
                            />
                        </div>

                        <Button
                            variant="ghost"
                            size="icon"
                            onclick={() => removeLine(position)}
                            disabled={form.items.length === 1}
                            aria-label={$_('Remove this line')}
                            title={$_('Remove this line from the invoice')}
                        >
                            <Trash2 class="size-4" />
                        </Button>
                    </div>
                {/each}

                <InputError message={form.errors.items} />

                <div class="flex items-center justify-between">
                    <Button variant="outline" size="sm" onclick={addLine}>
                        <Plus class="mr-2 size-4" />
                        {$_('Add another line')}
                    </Button>
                    <p class="text-xs text-muted-foreground">{lineSummary}</p>
                </div>
            </fieldset>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="tax_rate">{$_('Tax rate in percent')}</Label>
                    <Input
                        id="tax_rate"
                        type="number"
                        step="0.01"
                        min="0"
                        max="100"
                        bind:value={form.tax_rate}
                    />
                    <p class="text-xs text-muted-foreground">
                        {FIELD_HINTS.taxRate}
                    </p>
                    <InputError message={form.errors.tax_rate} />
                </div>

                <div class="grid gap-2">
                    <Label for="currency">{$_('Currency')}</Label>
                    <Input
                        id="currency"
                        bind:value={form.currency}
                        maxlength={3}
                        placeholder={$_('USD')}
                    />
                    <InputError message={form.errors.currency} />
                </div>
            </div>

            <div class="grid gap-2">
                <Label for="notes">{$_('Note to the client')}</Label>
                <textarea
                    id="notes"
                    bind:value={form.notes}
                    rows="3"
                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                    placeholder={$_('Thanks again for a great month of work.')}
                ></textarea>
                <p class="text-xs text-muted-foreground">{FIELD_HINTS.notes}</p>
                <InputError message={form.errors.notes} />
            </div>

            <div class="flex items-center gap-3">
                <Button type="submit" disabled={form.processing}>
                    {form.processing ? $_('Saving…') : $_('Save invoice')}
                </Button>
                <Button variant="ghost" asChild>
                    {#snippet children(props)}
                        <Link href={toUrl(index())} class={props.class}>
                            {$_('Cancel')}
                        </Link>
                    {/snippet}
                </Button>
            </div>
        </form>
    {/if}
</div>
