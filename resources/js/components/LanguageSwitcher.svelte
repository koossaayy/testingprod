<script>
  import { router, page } from '@inertiajs/svelte'

  $: current = $page.props.locale ?? 'en'
  $: locales = $page.props.locales ?? ['en', 'fr']

  function switchTo(event) {
    const next = event.target.value
    if (next !== current) router.get(`/locale/${next}`)
  }
</script>

<select value={current} on:change={switchTo} aria-label="Language">
  {#each locales as locale}
    <option value={locale}>{locale.toUpperCase()}</option>
  {/each}
</select>