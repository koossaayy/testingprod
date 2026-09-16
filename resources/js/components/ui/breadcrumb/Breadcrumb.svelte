<script>
import { _ } from 'svelte-i18n';
</script>

<nav aria-label={$_('breadcrumb')} class="text-sm">
    <slot />
</nav>
