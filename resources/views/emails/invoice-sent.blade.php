<x-mail::message>
# Invoice {{ $invoice->number }} is ready

Hi {{ $clientName }},

Thanks again for the work this month. Your invoice for **{{ $total }}** is set out below, and payment is due on {{ $dueOn }}.

<x-mail::panel>
Invoice number: {{ $invoice->number }}<br>
Issued on: {{ $invoice->issued_on->format('F j, Y') }}<br>
Amount due: {{ $total }}<br>
Payment terms: {{ $invoice->client->payment_terms_days }} days from the issue date
</x-mail::panel>

## What this covers

<x-mail::table>
| Work | Hours or units |
| :--- | -------------: |
@foreach ($invoice->items as $item)
| {{ $item->description }} | {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }} |
@endforeach
</x-mail::table>

<x-mail::button :url="$paymentUrl">
Pay this invoice
</x-mail::button>

If you have already sent the payment across, please ignore this reminder. Bank transfers can take a day or two to show up on our side.

Questions about any of the line items? Just reply to this email and {{ $senderName }} will get back to you within one working day. No question is too small, and it is always easier to sort things out before the due date.

Don&apos;t forget to quote the invoice number when you make the transfer, otherwise it can take us a while to match your payment to the right job.

Thanks for being a pleasure to work with,<br>
{{ $senderName }}

<x-mail::subcopy>
This invoice was sent by {{ $senderName }} using Freelance Invoice Tracker. If the button above does not work, copy and paste this link into your browser: {{ $paymentUrl }}

Terms &amp; conditions apply. Don&apos;t reply to this address if you need to dispute a charge, use the contact details on the invoice instead.

You are receiving this email because you are listed as the billing contact for {{ $invoice->client->name }}.
</x-mail::subcopy>
</x-mail::message>
