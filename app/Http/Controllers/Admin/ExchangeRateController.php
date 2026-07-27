<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExchangeRateController extends Controller
{
    private const CURRENCIES = ['BDT', 'INR', 'PKR'];

    public function index(): View
    {
        $rates = ExchangeRate::query()
            ->where('from_currency', 'LAK')
            ->whereIn('to_currency', self::CURRENCIES)
            ->get()
            ->keyBy('to_currency');

        return view('admin.exchange.index', compact('rates'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'rates' => ['required', 'array'],
            'rates.*.rate' => ['required', 'numeric', 'gt:0', 'decimal:0,8'],
            'rates.*.is_active' => ['nullable', 'boolean'],
        ]);

        foreach (self::CURRENCIES as $currency) {
            abort_unless(isset($validated['rates'][$currency]), 422);
            $data = $validated['rates'][$currency];

            ExchangeRate::query()->updateOrCreate(
                ['from_currency' => 'LAK', 'to_currency' => $currency],
                ['rate' => $data['rate'], 'is_active' => (bool) ($data['is_active'] ?? false)],
            );
        }

        return back()->with('status', 'Exchange rates were updated successfully.');
    }
}
