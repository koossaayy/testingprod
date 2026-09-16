<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ __('Freelance Invoice Tracker keeps every client, invoice and payment in one calm place so you always know what you are owed.') }}">
        <meta name="author" content="Freelance Invoice Tracker">
        <meta property="og:title" content="{{ __('Freelance Invoice Tracker') }}">
        <meta property="og:description" content="{{ __('Send invoices, chase late payments and see exactly what you have earned this year.') }}">
        <meta property="og:site_name" content="{{ __('Freelance Invoice Tracker') }}">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        <x-inertia::head>
            <title>{{ __('Freelance Invoice Tracker') }}</title>
        </x-inertia::head>
    </head>
    <body class="font-sans antialiased">
        <noscript>
            <p>{{ __('Freelance Invoice Tracker needs JavaScript turned on. Enable it in your browser settings and reload the page to carry on.') }}</p>
        </noscript>
        <x-inertia::app />
    </body>
</html>
