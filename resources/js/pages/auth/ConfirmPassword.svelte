<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    export const layout = {
        get title() { return get(_)('Confirm password'); },
        get description() { return get(_)('This is a secure area of the application. Please confirm your password before continuing.'); },
    };
</script>

<script lang="ts">
    import { Form } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import PasswordInput from '@/components/PasswordInput.svelte';
    import { Button } from '@/components/ui/button';
    import { Label } from '@/components/ui/label';
    import { Spinner } from '@/components/ui/spinner';
    import { store } from '@/routes/password/confirm';
    import {
        index as confirmOptions,
        store as confirmStore,
    } from '@/actions/Laravel/Passkeys/Http/Controllers/PasskeyConfirmationController';
    import PasskeyVerify from '@/components/PasskeyVerify.svelte';
</script>

<AppHead title={$_('Confirm password')} />

<PasskeyVerify
    routes={{
        options: confirmOptions(),
        submit: confirmStore(),
    }}
    label={$_('Confirm with passkey')}
    loadingLabel={$_('Confirming...')}
    separator={$_('Or confirm with password')}
/>

<Form {...store.form()} resetOnSuccess>
    {#snippet children({ errors, processing })}
        <div class="space-y-6">
            <div class="grid gap-2">
                <Label for="password">{$_('Password')}</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError message={errors.password} />
            </div>

            <div class="flex items-center">
                <Button
                    type="submit"
                    class="w-full"
                    disabled={processing}
                    data-test="confirm-password-button"
                >
                    {#if processing}<Spinner />{/if}
                    {$_('Confirm password')}
                </Button>
            </div>
        </div>
    {/snippet}
</Form>
