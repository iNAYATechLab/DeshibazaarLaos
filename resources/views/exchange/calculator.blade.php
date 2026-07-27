@extends('layouts.app', ['title' => 'Money Exchange Calculator · DeshiBazaar.com'])
@section('content')
<section class="bg-linear-to-br from-emerald-950 via-emerald-800 to-teal-700 px-4 py-14 text-white sm:px-6"><div class="mx-auto max-w-5xl"><p class="text-sm font-bold tracking-[0.2em] text-amber-300">LAOS MONEY EXCHANGE INQUIRY</p><h1 class="mt-3 text-4xl font-black tracking-tight sm:text-5xl">Check your LAK exchange estimate.</h1><p class="mt-4 max-w-2xl text-emerald-100">Calculate an indicative amount for Bangladesh, India, or Pakistan, then contact our team directly on WhatsApp to confirm your transfer.</p></div></section>
<section class="mx-auto max-w-5xl px-4 py-10 sm:px-6"><div class="grid gap-7 lg:grid-cols-[1.4fr,0.9fr]">
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><h2 class="text-xl font-black">Exchange calculator</h2><p class="mt-1 text-sm text-slate-500">Rates are indicative and subject to confirmation.</p>
@if($rates->isEmpty())<div class="mt-6 rounded-xl bg-amber-50 p-4 text-sm text-amber-900">Exchange rates are being updated. Please contact us on WhatsApp for a current quote.</div>@else
<div class="mt-7 grid gap-5 sm:grid-cols-2"><label class="block text-sm font-bold">You send (LAK)<input id="lakAmount" inputmode="decimal" min="0" type="number" value="100000" class="mt-2 w-full rounded-lg border-slate-300 px-3 py-3 text-lg focus:border-emerald-600 focus:ring-emerald-600"></label><label class="block text-sm font-bold">Recipient currency<select id="currency" class="mt-2 w-full rounded-lg border-slate-300 px-3 py-3 text-lg focus:border-emerald-600 focus:ring-emerald-600">@foreach($rates as $currency => $data)<option value="{{ $currency }}">{{ $currency }}</option>@endforeach</select></label></div>
<div class="mt-6 rounded-xl bg-emerald-50 p-5"><p class="text-sm font-bold text-emerald-800">Estimated recipient amount</p><p id="convertedAmount" class="mt-2 text-4xl font-black text-emerald-900">—</p><p id="rateDescription" class="mt-2 text-xs text-emerald-800"></p></div>
<button id="whatsappInquiry" class="mt-6 inline-flex w-full items-center justify-center rounded-lg bg-[#25D366] px-5 py-3 font-bold text-white hover:bg-[#1ebe5b]">Send Inquiry via WhatsApp</button>
@endif</div>
<aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"><h2 class="font-black">Important notice</h2><ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600"><li>• Calculator results are estimates based on the currently published rate.</li><li>• Final rate and transfer details must be confirmed by our team through WhatsApp.</li><li>• Do not send funds until you have received confirmation and approved instructions.</li></ul><a href="{{ route('home') }}" class="mt-6 inline-block text-sm font-bold text-emerald-700 hover:text-emerald-900">← Back to DeshiBazaar</a></aside>
</div></section>
@if(!$rates->isEmpty())
<script>
const rates = @json($rates); const whatsAppNumber = @json($whatsAppNumber);
const amountInput = document.getElementById('lakAmount'), currencyInput = document.getElementById('currency'), output = document.getElementById('convertedAmount'), description = document.getElementById('rateDescription');
const formatter = new Intl.NumberFormat(undefined, { maximumFractionDigits: 2 });
function calculate() { const amount = Math.max(0, Number(amountInput.value) || 0), currency = currencyInput.value, selected = rates[currency], converted = amount * Number(selected.rate); output.textContent = `${formatter.format(converted)} ${currency}`; description.textContent = `1 LAK = ${selected.rate} ${currency} · Last updated: ${selected.updated_at}`; return {amount, currency, converted}; }
amountInput.addEventListener('input', calculate); currencyInput.addEventListener('change', calculate); calculate();
document.getElementById('whatsappInquiry').addEventListener('click', () => { const {amount, currency, converted} = calculate(); const text = `Hello DeshiBazaar, I want to send ${formatter.format(amount)} LAK to ${currency}. Calculated Amount: ${formatter.format(converted)} ${currency}. Please confirm the current exchange rate and transfer process.`; const destination = whatsAppNumber ? `https://wa.me/${whatsAppNumber}?text=${encodeURIComponent(text)}` : `https://wa.me/?text=${encodeURIComponent(text)}`; window.open(destination, '_blank', 'noopener'); });
</script>
@endif
@endsection
