<script module lang="ts">
    import type { BadgeVariant, InvoiceStatusValue } from '@/types';

    /** The short label shown on the badge itself. */
    export const STATUS_LABELS: Record<InvoiceStatusValue, string> = {
        draft: 'Draft',
        sent: 'Awaiting payment',
        paid: 'Paid',
        overdue: 'Overdue',
        cancelled: 'Cancelled',
    };

    /** The tooltip copy explaining what each status means in practice. */
    export const STATUS_HINTS: Record<InvoiceStatusValue, string> = {
        draft: 'Nobody has seen this invoice yet. Send it when you are ready.',
        sent: 'The client has the invoice and the clock is ticking.',
        paid: 'The money landed. Nothing left to chase here.',
        overdue: 'The due date has passed. Time for a gentle nudge.',
        cancelled: 'This invoice was voided and will never be collected.',
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
    aria-label={`Invoice status: ${STATUS_LABELS[status]}`}
>
    {STATUS_LABELS[status]}
</Badge>
