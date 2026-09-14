<script lang="ts">
    import type { Snippet } from 'svelte';

    let {
        title,
        description,
        children,
    }: {
        title: string;
        description: string;
        children?: Snippet;
    } = $props();
</script>

<div
    class="flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-sidebar-border/70 px-6 py-16 text-center dark:border-sidebar-border"
>
    <h3 class="text-base font-semibold">{title}</h3>
    <p class="max-w-sm text-sm text-muted-foreground">{description}</p>
    {@render children?.()}
</div>
