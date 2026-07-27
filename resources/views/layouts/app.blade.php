<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DeshiBazaar.com | South Asian Grocery in Laos' }}</title>
    <meta name="description" content="{{ $description ?? 'DeshiBazaar Laos: fresh meats, South Asian groceries, exchange inquiries and WhatsApp ordering in Vientiane.' }}">
    <meta name="keywords" content="DeshiBazaar Laos, South Asian grocery Vientiane, halal meat Laos, Bangladeshi grocery, Indian grocery, Pakistani grocery">
    <meta property="og:type" content="website"><meta property="og:title" content="{{ $title ?? 'DeshiBazaar.com | South Asian Grocery in Laos' }}"><meta property="og:description" content="{{ $description ?? 'Fresh meats, groceries and WhatsApp ordering for South Asian communities in Laos.' }}"><meta property="og:url" content="{{ url()->current() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('home') }}" class="text-xl font-black tracking-tight text-emerald-700">DeshiBazaar<span class="text-amber-500">.com</span></a>
                <nav class="flex items-center gap-3 text-sm font-semibold"><a href="{{ route('store.index') }}" class="text-slate-600 hover:text-emerald-700">{{ __('Shop') }}</a><a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-emerald-700">{{ __('Cart') }} ({{ count(session('cart', [])) }})</a><form method="POST" action="{{ route('locale.set', app()->getLocale() === 'en' ? 'bn' : (app()->getLocale() === 'bn' ? 'hi' : 'en')) }}">@csrf<button class="rounded border border-slate-300 px-2 py-1 text-xs">{{ strtoupper(app()->getLocale()) }}</button></form><a href="{{ route('store.index') }}" class="text-slate-600 hover:text-emerald-700">Shop</a><a href="{{ route('contact') }}" class="text-slate-600 hover:text-emerald-700">Contact</a><a href="{{ route('exchange.calculator') }}" class="text-slate-600 hover:text-emerald-700">Exchange</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-emerald-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf <button class="rounded-lg bg-slate-900 px-3 py-2 text-white hover:bg-slate-700">Sign out</button></form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-lg bg-emerald-700 px-4 py-2 text-white hover:bg-emerald-800">Admin sign in</a>
                    @endauth
                </nav>
            </div>
        </header>
        <main class="flex-1">@yield('content')</main>
        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:justify-between sm:px-6">
                <span>© {{ now()->year }} DeshiBazaar.com · Serving South Asian communities in Laos</span>
                <span>System version {{ config('version.current') }}</span>
            </div>
        </footer>
    </div>
</body>
</html>
