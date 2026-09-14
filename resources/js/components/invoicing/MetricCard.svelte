<script lang="ts">
    import type { Component } from 'svelte';
    import {
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
    } from '@/components/ui/card';

    let {
        label,
        value,
        hint,
        icon,
    }: {
        label: string;
        value: string | number;
        hint: string;
        icon?: Component<{ class?: string }>;
    } = $props();

    const Icon = $derived(icon);
</script>

<Card>
    <CardHeader>
        <CardDescription>{label}</CardDescription>
        <CardTitle class="flex items-center gap-2 text-2xl tabular-nums">
            {#if Icon}
                <Icon class="size-5 text-muted-foreground" />
            {/if}
            {value}
        </CardTitle>
    </CardHeader>
    <CardContent>
        <p class="text-xs text-muted-foreground">{hint}</p>
    </CardContent>
</Card>
