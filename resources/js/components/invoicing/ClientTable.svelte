<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import Pencil from '@lucide/svelte/icons/pencil';
    import Trash2 from '@lucide/svelte/icons/trash-2';
    import { _ } from 'svelte-i18n';
    import ConfirmDialog from '@/components/ConfirmDialog.svelte';
    import { Badge } from '@/components/ui/badge';
    import { Button } from '@/components/ui/button';
    import { toUrl } from '@/lib/utils';
    import { destroy, edit } from '@/routes/clients';
    import type { ClientRow } from '@/types';

    let {
        clients,
    }: {
        clients: ClientRow[];
    } = $props();

    let confirmingClient = $state<ClientRow | null>(null);

    const confirmOpen = $derived(confirmingClient !== null);

    /** Describe how many invoices a client has, in plain language. */
    function invoiceSummary(client: ClientRow): string {
        if (client.invoices_count === 0) {
            return $_('No invoices yet');
        }

        return `${client.invoices_count} ${client.invoices_count === 1 ? 'invoice' : 'invoices'}`;
    }

    function deleteClient() {
        const client = confirmingClient;

        if (!client) {
            return;
        }

        confirmingClient = null;

        console.log('[clients] deleting record', client.id);

        router.delete(toUrl(destroy(client.id)), {
            preserveScroll: true,
        });
    }
</script>

<div class="overflow-x-auto rounded-xl border">
    <table class="w-full text-left text-sm">
        <caption class="sr-only">
            {$_('The people and companies you bill, with their payment terms.')}
        </caption>
        <thead class="border-b bg-muted/50 text-xs text-muted-foreground uppercase">
            <tr>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Client')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Main contact')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Email')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Payment terms')}</th>
                <th scope="col" class="px-4 py-3 font-medium">{$_('Invoices')}</th>
                <th scope="col" class="px-4 py-3 text-right font-medium">
                    <span class="sr-only">{$_('Actions')}</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y">
            {#each clients as client (client.id)}
                <tr class="hover:bg-muted/40">
                    <td class="px-4 py-3 font-medium">
                        <span>{client.name}</span>
                        {#if client.is_archived}
                            <Badge variant="outline" class="ml-2">{$_('Archived')}</Badge>
                        {/if}
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">
                        {client.contact_name ?? $_('No contact saved')}
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">
                        <a
                            href={`mailto:${client.email}`}
                            class="underline-offset-4 hover:underline"
                            title={$_('Send an email to {0}', { values: { 0: client.name } })}
                        >
                            {client.email}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">
                        {$_('{0} days', { values: { 0: client.payment_terms_days } })}
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">
                        {invoiceSummary(client)}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-1">
                            <Button variant="ghost" size="icon" asChild>
                                {#snippet children(props)}
                                    <Link
                                        href={toUrl(edit(client.id))}
                                        class={props.class}
                                        aria-label={$_('Edit {0}', { values: { 0: client.name } })}
                                        title={$_('Edit this client')}
                                    >
                                        <Pencil class="size-4" />
                                    </Link>
                                {/snippet}
                            </Button>
                            <Button
                                variant="ghost"
                                size="icon"
                                aria-label={$_('Delete {0}', { values: { 0: client.name } })}
                                title={$_('Delete this client')}
                                onclick={() => (confirmingClient = client)}
                            >
                                <Trash2 class="size-4" />
                            </Button>
                        </div>
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>

<ConfirmDialog
    open={confirmOpen}
    title={$_('Delete this client?')}
    description={$_('Deleting {0} also removes every invoice you have raised for them. You cannot undo this.', { values: { 0: confirmingClient?.name ?? 'this client' } })}
    confirmLabel={$_('Delete client')}
    cancelLabel={$_('Keep client')}
    onConfirm={deleteClient}
    onCancel={() => (confirmingClient = null)}
/>
