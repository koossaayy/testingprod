<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import BookOpen from '@lucide/svelte/icons/book-open';
    import FolderGit2 from '@lucide/svelte/icons/folder-git-2';
    import LayoutGrid from '@lucide/svelte/icons/layout-grid';
    import ReceiptText from '@lucide/svelte/icons/receipt-text';
    import Settings2 from '@lucide/svelte/icons/settings-2';
    import Users from '@lucide/svelte/icons/users';
    import type { Snippet } from 'svelte';
    import AppLogo from '@/components/AppLogo.svelte';
    import NavFooter from '@/components/NavFooter.svelte';
    import NavMain from '@/components/NavMain.svelte';
    import NavUser from '@/components/NavUser.svelte';
    import {
        Sidebar,
        SidebarContent,
        SidebarFooter,
        SidebarHeader,
        SidebarMenu,
        SidebarMenuButton,
        SidebarMenuItem,
    } from '@/components/ui/sidebar';
    import { toUrl } from '@/lib/utils';
    import { dashboard } from '@/routes';
    import { index as clientsIndex } from '@/routes/clients';
    import { edit as invoicingSettings } from '@/routes/invoicing';
    import { index as invoicesIndex } from '@/routes/invoices';
    import type { NavItem } from '@/types';

    let {
        children,
    }: {
        children?: Snippet;
    } = $props();

    const mainNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
            icon: LayoutGrid,
        },
        {
            title: 'Clients',
            href: clientsIndex(),
            icon: Users,
        },
        {
            title: 'Invoices',
            href: invoicesIndex(),
            icon: ReceiptText,
        },
        {
            title: 'Invoicing settings',
            href: invoicingSettings(),
            icon: Settings2,
        },
    ];

    const footerNavItems: NavItem[] = [
        {
            title: 'Help centre',
            href: 'https://laravel.com/docs/starter-kits#svelte',
            icon: BookOpen,
        },
        {
            title: 'Report a problem',
            href: 'https://github.com/laravel/svelte-starter-kit',
            icon: FolderGit2,
        },
    ];
</script>

<Sidebar collapsible="icon" variant="inset">
    <SidebarHeader>
        <SidebarMenu>
            <SidebarMenuItem>
                <SidebarMenuButton size="lg" asChild>
                    {#snippet children(props)}
                        <Link
                            {...props}
                            href={toUrl(dashboard())}
                            class={props.class}
                        >
                            <AppLogo />
                        </Link>
                    {/snippet}
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
        <NavMain items={mainNavItems} />
    </SidebarContent>

    <SidebarFooter>
        <NavFooter items={footerNavItems} />
        <NavUser />
    </SidebarFooter>
</Sidebar>
{@render children?.()}
