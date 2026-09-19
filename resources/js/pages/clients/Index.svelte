<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    import { index } from '@/routes/clients';

    export const layout = {
        breadcrumbs: [
            {
                get title() { return get(_)('Clients'); },
                href: index(),
            },
        ],
    };
</script>

<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import Search from '@lucide/svelte/icons/search';
    import AppHead from '@/components/AppHead.svelte';
    import EmptyState from '@/components/EmptyState.svelte';
    import ClientTable from '@/components/invoicing/ClientTable.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { toUrl } from '@/lib/utils';
    import { create } from '@/routes/clients';
    import type { ClientRow } from '@/types';

    let {
        clients,
    }: {
        clients: ClientRow[];
    } = $props();

    let searchTerm = $state('');

    const visibleClients = $derived(
        clients.filter((client) =>
            `${client.name} ${client.contact_name ?? ''} ${client.email}`
                .toLowerCase()
                .includes(searchTerm.trim().toLowerCase()),
        ),
    );

    const resultSummary = $derived(
        $_('{0, plural, one {# client matches your search} other {# clients match your search}}', { values: { 0: visibleClients.length } }),
    );
</script>

<AppHead title={$_('Clients')} />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">{$_('Clients')}</h1>
            <p class="text-sm text-muted-foreground">
                {$_('Everyone you bill, along with the terms you agreed and how much work you have invoiced them for.')}
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title={$_('Add someone new to your client list')}
                >
                    {$_('Add client')}
                </Link>
            {/snippet}
        </Button>
    </header>

    {#if clients.length === 0}
        <EmptyState
            title={$_('No clients yet')}
            description={$_('Add the first company or person you work with, and their details will be filled in automatically on every invoice you raise.')}
        >
            <Button asChild>
                {#snippet children(props)}
                    <Link href={toUrl(create())} class={props.class}>
                        {$_('Add your first client')}
                    </Link>
                {/snippet}
            </Button>
        </EmptyState>
    {:else}
        <div class="flex flex-col gap-3">
            <div class="relative max-w-sm">
                <Search
                    class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                />
                <Input
                    bind:value={searchTerm}
                    class="pl-9"
                    type="search"
                    placeholder={$_('Search by name, contact or email')}
                    aria-label={$_('Search your clients')}
                />
            </div>

            {#if visibleClients.length === 0}
                <EmptyState
                    title={$_('Nothing matched that search')}
                    description={$_('Try a shorter phrase, or clear the search box to see every client again.')}
                />
            {:else}
                <ClientTable clients={visibleClients} />
                <p class="text-xs text-muted-foreground">{resultSummary}</p>
            {/if}
        </div>
    {/if}
</div>
