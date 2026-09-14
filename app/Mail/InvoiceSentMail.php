<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Support\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invoice $invoice) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Invoice :number from :name', ['number' => $this->invoice->number, 'name' => $this->invoice->user->name]),
            metadata: [
                'invoice_number' => $this->invoice->number,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invoice-sent',
            with: [
                'invoice' => $this->invoice,
                'clientName' => $this->invoice->client->contact_name ?? $this->invoice->client->name,
                'senderName' => $this->invoice->user->name,
                'total' => Money::format($this->invoice->totalCents(), $this->invoice->currency),
                'dueOn' => $this->invoice->due_on->format('F j, Y'),
                'paymentUrl' => route('public-invoice.paid', $this->invoice->public_token),
            ],
        );
    }
}
