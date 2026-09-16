<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Invoice :param_1 payment confirmation', ['param_1' => $invoice->number]) }}</title>
        <meta name="description" content="Payment confirmation for invoice {{ $invoice->number }} issued by {{ $invoice->user->name }}.">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        @vite(['resources/css/app.css'])
    </head>
    <body class="flex min-h-full items-center justify-center bg-neutral-50 p-6 font-sans text-neutral-900 antialiased">
        <main class="w-full max-w-xl rounded-2xl border border-neutral-200 bg-white p-8 shadow-sm">
            @if ($isPaid)
                <p class="text-sm font-medium tracking-wide text-emerald-600 uppercase">{{ __('Payment received') }}</p>
                <h1 class="mt-2 text-2xl font-semibold">{{ __('Thank you, we&apos;re all square') }}</h1>
                <p class="mt-3 text-neutral-600">
                    {{ __('Invoice :param_1 was paid in full on :param_2. There is nothing else for you to do.', ['param_1' => $invoice->number, 'param_2' => $paidOn]) }}
                </p>
            @else
                <p class="text-sm font-medium tracking-wide text-amber-600 uppercase">{{ __('Awaiting payment') }}</p>
                <h1 class="mt-2 text-2xl font-semibold">{{ __('This invoice is still open') }}</h1>
                <p class="mt-3 text-neutral-600">
                    {{ __('Invoice :param_1 has not been settled yet. Payment is due on :param_2.', ['param_1' => $invoice->number, 'param_2' => $dueOn]) }}
                </p>
            @endif

            <dl class="mt-8 divide-y divide-neutral-200 border-y border-neutral-200 text-sm">
                <div class="flex justify-between py-3">
                    <dt class="text-neutral-500">{{ __('Billed to') }}</dt>
                    <dd class="font-medium">{{ $invoice->client->name }}</dd>
                </div>
                <div class="flex justify-between py-3">
                    <dt class="text-neutral-500">{{ __('Issued by') }}</dt>
                    <dd class="font-medium">{{ $invoice->user->name }}</dd>
                </div>
                <div class="flex justify-between py-3">
                    <dt class="text-neutral-500">{{ __('Invoice number') }}</dt>
                    <dd class="font-medium">{{ $invoice->number }}</dd>
                </div>
                <div class="flex justify-between py-3">
                    <dt class="text-neutral-500">{{ __('Amount') }}</dt>
                    <dd class="font-medium">{{ $total }}</dd>
                </div>
                @if ($isPaid)
                    <div class="flex justify-between py-3">
                        <dt class="text-neutral-500">{{ __('Paid with') }}</dt>
                        <dd class="font-medium">{{ $invoice->payment_method ?? __('Bank transfer') }}</dd>
                    </div>
                @endif
            </dl>

            <h2 class="mt-8 text-base font-semibold">{{ __('What was billed') }}</h2>
            <ul class="mt-3 space-y-2 text-sm text-neutral-600">
                @foreach ($invoice->items as $item)
                    <li class="flex justify-between gap-4">
                        <span>{{ $item->description }}</span>
                        <span class="shrink-0 tabular-nums">&times; {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <p class="mt-8 text-sm text-neutral-500">
                {{ __('Keep this page for your records. If something looks wrong, reply to the invoice email and we&apos;ll sort it out together.') }}
            </p>
            <p class="mt-2 text-xs text-neutral-400">
                {{ __('Terms &amp; conditions apply. This confirmation is not a tax receipt.') }}
            </p>
        </main>
    </body>
</html>
