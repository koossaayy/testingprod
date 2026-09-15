import { createInertiaApp, router } from '@inertiajs/svelte';
import AppLayout from '@/layouts/AppLayout.svelte';
import AuthLayout from '@/layouts/AuthLayout.svelte';
import SettingsLayout from '@/layouts/settings/Layout.svelte';
import { initializeFlashToast } from '@/lib/flash-toast';
import { initializeTheme } from '@/lib/theme.svelte';
import './i18n-setup';
import { locale } from 'svelte-i18n';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

void createInertiaApp({
    withApp(_context, { ssr, page }) {
        locale.set(String(page.props.locale ?? 'en'));
        if (!ssr) {
            router.on('navigate', (event) => {
                locale.set(String(event.detail.page.props.locale ?? 'en'));
            });
        }
    },
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
                return null;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();

// This will listen for flash toast data from the server...
initializeFlashToast();
