<script module lang="ts">
    import { edit } from '@/routes/invoicing';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Invoicing settings',
                href: edit(),
            },
        ],
    };
</script>

<script lang="ts">
    import { page, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import Heading from '@/components/Heading.svelte';
    import InputError from '@/components/InputError.svelte';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { toUrl } from '@/lib/utils';
    import { update } from '@/routes/invoicing';
    import type { InvoicingPreferences } from '@/types';

    let {
        preferences,
    }: {
        preferences: InvoicingPreferences;
    } = $props();

    const form = useForm(() => ({ ...preferences }));

    const successMessage = $derived(page.props.flash?.success as string | undefined);

    const numberPreview = $derived(
        `${form.invoice_prefix || 'INV'}-${new Date().getFullYear()}-001`,
    );

    function submit(event: SubmitEvent) {
        event.preventDefault();

        form.patch(toUrl(update()));
    }
</script>

<AppHead title="Invoicing settings" />

<h1 class="sr-only">Invoicing settings</h1>

<div class="flex flex-col space-y-6">
    <Heading
        variant="small"
        title="Invoicing"
        description="Set the defaults we apply to every new invoice you raise"
    />

    {#if successMessage}
        <div
            class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950 dark:text-emerald-200"
            role="status"
        >
            {successMessage}
        </div>
    {/if}

    <form onsubmit={submit} class="space-y-6">
        <div class="grid gap-2">
            <Label for="business_name">Business name</Label>
            <Input
                id="business_name"
                bind:value={form.business_name}
                required
                placeholder="The name that appears at the top of your invoices"
            />
            <InputError message={form.errors.business_name} />
        </div>

        <div class="grid gap-2">
            <Label for="invoice_prefix">Invoice number prefix</Label>
            <Input
                id="invoice_prefix"
                bind:value={form.invoice_prefix}
                maxlength={10}
                placeholder="INV"
            />
            <p class="text-xs text-muted-foreground">
                Your next invoice will be numbered {numberPreview}.
            </p>
            <InputError message={form.errors.invoice_prefix} />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="grid gap-2">
                <Label for="default_payment_terms_days">
                    Default payment terms
                </Label>
                <Input
                    id="default_payment_terms_days"
                    type="number"
                    min="0"
                    max="180"
                    bind:value={form.default_payment_terms_days}
                    title="How many days a client gets to pay"
                />
                <InputError message={form.errors.default_payment_terms_days} />
            </div>

            <div class="grid gap-2">
                <Label for="default_tax_rate">Default tax rate</Label>
                <Input
                    id="default_tax_rate"
                    type="number"
                    step="0.01"
                    min="0"
                    max="100"
                    bind:value={form.default_tax_rate}
                />
                <InputError message={form.errors.default_tax_rate} />
            </div>
        </div>

        <div class="grid gap-2">
            <Label for="payment_instructions">Payment instructions</Label>
            <textarea
                id="payment_instructions"
                bind:value={form.payment_instructions}
                rows="4"
                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                placeholder="Bank name, account number and any reference your client should quote"
            ></textarea>
            <p class="text-xs text-muted-foreground">
                This block is printed at the bottom of every invoice. Don&apos;t
                include anything you would not want forwarded on.
            </p>
            <InputError message={form.errors.payment_instructions} />
        </div>

        <div class="flex items-start gap-3 rounded-lg border p-4">
            <Checkbox
                id="send_payment_reminders"
                bind:checked={form.send_payment_reminders}
                aria-label="Send automatic payment reminders"
            />
            <div class="grid gap-1">
                <Label for="send_payment_reminders">
                    Send automatic payment reminders
                </Label>
                <p class="text-xs text-muted-foreground">
                    We email the client three days before an invoice is due, and
                    again the morning after it goes overdue.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <Button type="submit" disabled={form.processing}>
                {form.processing ? 'Saving…' : 'Save preferences'}
            </Button>
            {#if form.recentlySuccessful}
                <p class="text-sm text-muted-foreground">Saved.</p>
            {/if}
        </div>
    </form>
</div>
