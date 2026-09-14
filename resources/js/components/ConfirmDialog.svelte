<script lang="ts">
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
        title = 'Are you sure?',
        description = 'This cannot be undone, so take a second before you commit.',
        confirmLabel = 'Yes, go ahead',
        cancelLabel = 'Never mind',
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
                title="Close this dialog and change nothing"
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
