<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\View\View;

class ExchangeCalculatorController extends Controller
{
    public function __invoke(): View
    {
        $rates = ExchangeRate::query()
            ->active()
            ->where('from_currency', 'LAK')
            ->whereIn('to_currency', ['BDT', 'INR', 'PKR'])
            ->orderBy('to_currency')
            ->get(['to_currency', 'rate', 'updated_at'])
            ->mapWithKeys(fn (ExchangeRate $rate) => [$rate->to_currency => [
                'rate' => (float) $rate->rate,
                'updated_at' => $rate->updated_at->timezone(config('app.timezone'))->format('d M Y, H:i'),
            ]]);

        return view('exchange.calculator', [
            'rates' => $rates,
            'whatsAppNumber' => preg_replace('/\D/', '', config('deshibazaar.whatsapp_inquiry_number')),
        ]);
    }
}
