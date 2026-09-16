<script lang="ts">
    import { page, router } from '@inertiajs/svelte';

    const current = $derived(String(page.props.locale ?? 'en'));
    const locales = $derived((page.props.locales as string[] | undefined) ?? ['en', 'fr']);

    function switchTo(event: Event) {
        const next = (event.currentTarget as HTMLSelectElement).value;
        if (next !== current) router.get(`/locale/${next}`);
    }
</script>

<select value={current} onchange={switchTo} aria-label="Language">
    {#each locales as locale (locale)}
        <option value={locale}>{locale.toUpperCase()}</option>
    {/each}
</select>