<script module lang="ts">
    import { index } from '@/routes/clients';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Clients',
                href: index(),
            },
        ],
    };
</script>

<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { toUrl } from '@/lib/utils';
    import { store, update } from '@/routes/clients';
    import type { ClientRecord } from '@/types';

    let {
        client,
    }: {
        client: ClientRecord | null;
    } = $props();

    const isEditing = $derived(client !== null);

    const form = useForm(() => ({
        name: client?.name ?? '',
        contact_name: client?.contact_name ?? '',
        email: client?.email ?? '',
        phone: client?.phone ?? '',
        company_number: client?.company_number ?? '',
        billing_address: client?.billing_address ?? '',
        currency: client?.currency ?? 'USD',
        payment_terms_days: client?.payment_terms_days ?? 14,
        notes: client?.notes ?? '',
        is_archived: client?.is_archived ?? false,
    }));

    const pageTitle = $derived(isEditing ? 'Edit client' : 'Add a client');

    const pageDescription = $derived(
        isEditing
            ? 'Update the details we print on every invoice for this client.'
            : 'Tell us who you are billing. You can change any of this later.',
    );

    /** Explain the payment terms in the same words you would use out loud. */
    const termsHint = $derived(
        form.payment_terms_days === 0
            ? 'Invoices for this client will be marked due on the day you issue them.'
            : `Invoices will fall due ${form.payment_terms_days} days after you issue them.`,
    );

    function submit(event: SubmitEvent) {
        event.preventDefault();

        if (isEditing && client) {
            form.put(toUrl(update(client.id)));

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

    <form onsubmit={submit} class="max-w-2xl space-y-6">
        <div class="grid gap-2">
            <Label for="name">Client name</Label>
            <Input
                id="name"
                bind:value={form.name}
                required
                placeholder="Northwind Coffee Roasters"
                aria-describedby="name-hint"
            />
            <p id="name-hint" class="text-xs text-muted-foreground">
                Use the legal name if you invoice a company, so their finance
                team can match it to their records.
            </p>
            <InputError message={form.errors.name} />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="grid gap-2">
                <Label for="contact_name">Main contact</Label>
                <Input
                    id="contact_name"
                    bind:value={form.contact_name}
                    placeholder="Who signs off the invoice?"
                />
                <InputError message={form.errors.contact_name} />
            </div>

            <div class="grid gap-2">
                <Label for="email">Billing email</Label>
                <Input
                    id="email"
                    type="email"
                    bind:value={form.email}
                    required
                    placeholder="accounts@example.com"
                />
                <InputError message={form.errors.email} />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="grid gap-2">
                <Label for="phone">Phone number</Label>
                <Input
                    id="phone"
                    bind:value={form.phone}
                    placeholder="Optional, handy for late payments"
                />
                <InputError message={form.errors.phone} />
            </div>

            <div class="grid gap-2">
                <Label for="company_number">Company registration number</Label>
                <Input
                    id="company_number"
                    bind:value={form.company_number}
                    placeholder="Shown on the invoice footer"
                />
                <InputError message={form.errors.company_number} />
            </div>
        </div>

        <div class="grid gap-2">
            <Label for="billing_address">Billing address</Label>
            <textarea
                id="billing_address"
                bind:value={form.billing_address}
                rows="3"
                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                placeholder="Street, city and postcode as it should appear on the invoice"
            ></textarea>
            <InputError message={form.errors.billing_address} />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="grid gap-2">
                <Label for="currency">Currency</Label>
                <Input
                    id="currency"
                    bind:value={form.currency}
                    maxlength={3}
                    placeholder="USD"
                    title="Three letter currency code, for example USD or EUR"
                />
                <InputError message={form.errors.currency} />
            </div>

            <div class="grid gap-2">
                <Label for="payment_terms_days">Payment terms in days</Label>
                <Input
                    id="payment_terms_days"
                    type="number"
                    min="0"
                    max="180"
                    bind:value={form.payment_terms_days}
                />
                <p class="text-xs text-muted-foreground">{termsHint}</p>
                <InputError message={form.errors.payment_terms_days} />
            </div>
        </div>

        <div class="grid gap-2">
            <Label for="notes">Private notes</Label>
            <textarea
                id="notes"
                bind:value={form.notes}
                rows="3"
                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                placeholder="Anything worth remembering before the next project"
            ></textarea>
            <p class="text-xs text-muted-foreground">
                Only you can see these notes. They never appear on an invoice.
            </p>
            <InputError message={form.errors.notes} />
        </div>

        {#if isEditing}
            <div class="flex items-start gap-3 rounded-lg border p-4">
                <Checkbox
                    id="is_archived"
                    bind:checked={form.is_archived}
                    aria-label="Archive this client"
                />
                <div class="grid gap-1">
                    <Label for="is_archived">Archive this client</Label>
                    <p class="text-xs text-muted-foreground">
                        Archived clients stay in your history but stop showing up
                        when you create a new invoice.
                    </p>
                </div>
            </div>
        {/if}

        <div class="flex items-center gap-3">
            <Button type="submit" disabled={form.processing}>
                {form.processing ? 'Saving…' : 'Save client'}
            </Button>
            <Button variant="ghost" asChild>
                {#snippet children(props)}
                    <Link href={toUrl(index())} class={props.class}>Cancel</Link>
                {/snippet}
            </Button>
        </div>
    </form>
</div>
