import { getContext } from 'svelte';
import { SIDEBAR_CONTEXT, type SidebarContext } from './context';
import i18n from '../../../i18n-setup';

export function useSidebar(): SidebarContext {
    const context = getContext<SidebarContext>(SIDEBAR_CONTEXT);

    if (!context) {
        throw new Error(i18n.t('Sidebar context is not available'));
    }

    return context;
}
