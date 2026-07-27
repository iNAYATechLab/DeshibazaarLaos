@extends('layouts.admin')
@section('heading', 'Money Exchange Rates')
@section('content')
<div class="max-w-4xl">
    <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900"><strong>Daily rate control.</strong> Enter the destination-currency amount received for 1 LAK. Rates are indicative only and are published immediately to the public calculator.</div>
    @if (session('status'))<div class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">{{ session('status') }}</div>@endif
    <form method="POST" action="{{ route('admin.exchange-rates.update') }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf @method('PUT')
        <div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-4">Pair</th><th class="px-5 py-4">1 LAK equals</th><th class="px-5 py-4">Calculator status</th><th class="px-5 py-4">Last updated</th></tr></thead><tbody class="divide-y divide-slate-100">
        @foreach (['BDT' => 'Bangladeshi Taka', 'INR' => 'Indian Rupee', 'PKR' => 'Pakistani Rupee'] as $currency => $name)
            @php($exchangeRate = $rates->get($currency))
            <tr><td class="px-5 py-4"><strong>LAK → {{ $currency }}</strong><span class="mt-1 block text-xs text-slate-500">{{ $name }}</span></td><td class="px-5 py-4"><input required step="0.00000001" min="0.00000001" type="number" name="rates[{{ $currency }}][rate]" value="{{ old("rates.$currency.rate", $exchangeRate?->rate) }}" placeholder="e.g. 0.00250000" class="w-48 rounded-lg border-slate-300 px-3 py-2 focus:border-emerald-600 focus:ring-emerald-600">@error("rates.$currency.rate")<span class="mt-1 block text-xs text-red-600">{{ $message }}</span>@enderror</td><td class="px-5 py-4"><input type="hidden" name="rates[{{ $currency }}][is_active]" value="0"><label class="inline-flex items-center gap-2 font-semibold"><input type="checkbox" name="rates[{{ $currency }}][is_active]" value="1" @checked(old("rates.$currency.is_active", $exchangeRate?->is_active)) class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600"> Active</label></td><td class="px-5 py-4 text-slate-500">{{ $exchangeRate?->updated_at?->format('d M Y, H:i') ?? 'Not set' }}</td></tr>
        @endforeach
        </tbody></table></div>
        <div class="flex justify-end border-t border-slate-100 p-5"><button class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-bold text-white hover:bg-emerald-800">Save daily rates</button></div>
    </form>
</div>
@endsection
