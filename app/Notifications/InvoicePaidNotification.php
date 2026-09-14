<?php

namespace App\Notifications;

use App\Models\Invoice;
use App\Support\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaidNotification extends Notification
{
    use Queueable;

    public function __construct(public Invoice $invoice) {}

    /**
     * Get the delivery channels for this notification.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Build the email confirming the payment landed.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $total = Money::format($this->invoice->totalCents(), $this->invoice->currency);

        return (new MailMessage)
            ->subject("Payment received for invoice {$this->invoice->number}")
            ->greeting('Good news!')
            ->line("{$this->invoice->client->name} has paid invoice {$this->invoice->number}.")
            ->line("The full amount of {$total} has been recorded against the invoice.")
            ->action('View the invoice', route('invoices.show', $this->invoice))
            ->line('Nothing else to do here. Go and enjoy the rest of your day.')
            ->salutation('Happy invoicing, the Freelance Invoice Tracker team');
    }

    /**
     * Get the payload stored for the in-app activity feed.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'invoice_number' => $this->invoice->number,
            'title' => 'Invoice marked as paid',
            'body' => "{$this->invoice->client->name} settled invoice {$this->invoice->number} in full.",
            'action_label' => 'Open the invoice',
            'action_url' => route('invoices.show', $this->invoice),
        ];
    }
}
