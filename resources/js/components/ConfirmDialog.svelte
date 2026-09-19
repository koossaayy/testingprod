<script lang="ts">
    import { _ } from 'svelte-i18n';
    import { Button } from '@/components/ui/button';
    import {
        Dialog,
        DialogContent,
        DialogDescription,
        DialogFooter,
        DialogTitle,
    } from '@/components/ui/dialog';

    let {
        open = false,
        title = $_('Are you sure?'),
        description = $_('This cannot be undone, so take a second before you commit.'),
        confirmLabel = $_('Yes, go ahead'),
        cancelLabel = $_('Never mind'),
        destructive = true,
        onConfirm,
        onCancel,
    }: {
        open?: boolean;
        title?: string;
        description?: string;
        confirmLabel?: string;
        cancelLabel?: string;
        destructive?: boolean;
        onConfirm: () => void;
        onCancel: () => void;
    } = $props();
</script>

<Dialog {open} onOpenChange={(value) => (value ? undefined : onCancel())}>
    <DialogContent>
        <DialogTitle>{title}</DialogTitle>
        <DialogDescription>{description}</DialogDescription>

        <DialogFooter class="gap-2">
            <Button
                variant="outline"
                onclick={onCancel}
                title={$_('Close this dialog and change nothing')}
            >
                {cancelLabel}
            </Button>
            <Button
                variant={destructive ? 'destructive' : 'default'}
                onclick={onConfirm}
            >
                {confirmLabel}
            </Button>
        </DialogFooter>
    </DialogContent>
</Dialog>
