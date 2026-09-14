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
        visibleClients.length === 1
            ? '1 client matches your search'
            : `${visibleClients.length} clients match your search`,
    );
</script>

<AppHead title="Clients" />

<div class="flex h-full flex-1 flex-col gap-6 p-4">
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Clients</h1>
            <p class="text-sm text-muted-foreground">
                Everyone you bill, along with the terms you agreed and how much
                work you have invoiced them for.
            </p>
        </div>
        <Button asChild>
            {#snippet children(props)}
                <Link
                    href={toUrl(create())}
                    class={props.class}
                    title="Add someone new to your client list"
                >
                    Add client
                </Link>
            {/snippet}
        </Button>
    </header>

    {#if clients.length === 0}
        <EmptyState
            title="No clients yet"
            description="Add the first company or person you work with, and their details will be filled in automatically on every invoice you raise."
        >
            <Button asChild>
                {#snippet children(props)}
                    <Link href={toUrl(create())} class={props.class}>
                        Add your first client
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
                    placeholder="Search by name, contact or email"
                    aria-label="Search your clients"
                />
            </div>

            {#if visibleClients.length === 0}
                <EmptyState
                    title="Nothing matched that search"
                    description="Try a shorter phrase, or clear the search box to see every client again."
                />
            {:else}
                <ClientTable clients={visibleClients} />
                <p class="text-xs text-muted-foreground">{resultSummary}</p>
            {/if}
        </div>
    {/if}
</div>
