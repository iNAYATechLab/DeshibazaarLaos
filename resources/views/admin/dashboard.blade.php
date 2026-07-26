@extends('layouts.admin')
@section('heading', 'Dashboard overview')
@section('content')
<div class="rounded-2xl bg-linear-to-br from-emerald-800 to-teal-700 p-7 text-white shadow-sm"><p class="text-sm font-bold uppercase tracking-widest text-emerald-100">Welcome back</p><h2 class="mt-2 text-3xl font-black">{{ auth()->user()->name }}</h2><p class="mt-3 max-w-2xl text-emerald-50">The foundation is ready. Store, exchange-rate, WhatsApp inquiry, and settings modules will appear here as they are approved and delivered.</p></div>
<div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">@foreach ([['Products & Categories','Awaiting module'],['Exchange Rates','Awaiting module'],['Inquiry Logs','Awaiting module'],['System Settings','Awaiting module']] as [$label, $state])<article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm"><p class="text-sm font-bold text-slate-500">{{ $label }}</p><p class="mt-3 text-lg font-black text-slate-800">{{ $state }}</p></article>@endforeach</div>
@endsection
