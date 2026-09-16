<script module lang="ts">
    import { get } from 'svelte/store';
    import { _ } from 'svelte-i18n';
    import type { BadgeVariant, InvoiceStatusValue } from '@/types';

    /** The short label shown on the badge itself. */
    export const STATUS_LABELS: Record<InvoiceStatusValue, string> = {
        get draft() { return get(_)('Draft'); },
        get sent() { return get(_)('Awaiting payment'); },
        get paid() { return get(_)('Paid'); },
        get overdue() { return get(_)('Overdue'); },
        get cancelled() { return get(_)('Cancelled'); },
    };

    /** The tooltip copy explaining what each status means in practice. */
    export const STATUS_HINTS: Record<InvoiceStatusValue, string> = {
        get draft() { return get(_)('Nobody has seen this invoice yet. Send it when you are ready.'); },
        get sent() { return get(_)('The client has the invoice and the clock is ticking.'); },
        get paid() { return get(_)('The money landed. Nothing left to chase here.'); },
        get overdue() { return get(_)('The due date has passed. Time for a gentle nudge.'); },
        get cancelled() { return get(_)('This invoice was voided and will never be collected.'); },
    };

    const STATUS_VARIANTS: Record<InvoiceStatusValue, BadgeVariant> = {
        draft: 'secondary',
        sent: 'default',
        paid: 'default',
        overdue: 'destructive',
        cancelled: 'outline',
    };

    const STATUS_CLASSES: Record<InvoiceStatusValue, string> = {
        draft: '',
        sent: 'bg-sky-600 text-white',
        paid: 'bg-emerald-600 text-white',
        overdue: '',
        cancelled: 'text-muted-foreground',
    };
</script>

<script lang="ts">
    import { Badge } from '@/components/ui/badge';

    let {
        status,
    }: {
        status: InvoiceStatusValue;
    } = $props();
</script>

<Badge
    variant={STATUS_VARIANTS[status]}
    class={STATUS_CLASSES[status]}
    title={STATUS_HINTS[status]}
    aria-label={$_('Invoice status: {0}', { values: { 0: STATUS_LABELS[status] } })}
>
    {STATUS_LABELS[status]}
</Badge>
