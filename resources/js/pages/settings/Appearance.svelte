<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    import { edit as editAppearance } from '@/routes/appearance';

    export const layout = {
        breadcrumbs: [
            {
                get title() { return get(_)('Appearance settings'); },
                href: editAppearance(),
            },
        ],
    };
</script>

<script lang="ts">
    import AppearanceTabs from '@/components/AppearanceTabs.svelte';
    import AppHead from '@/components/AppHead.svelte';
    import Heading from '@/components/Heading.svelte';
</script>

<AppHead title={$_('Appearance settings')} />

<h1 class="sr-only">{$_('Appearance settings')}</h1>

<div class="space-y-6">
    <Heading
        variant="small"
        title={$_('Appearance settings')}
        description={$_('Update the appearance settings for your account')}
    />
    <AppearanceTabs />
</div>
