<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

use Inertia\Inertia;

class XrateController extends Controller
{
    public function index ()
    {
        return Inertia::render('Xrate/Index', [
            'conversion' => Inertia::optional(fn () => self::rates())
        ]);
    }

    public function rates (Request $request)
    {
        // Unvalidated, unsecure... TESTING
        $rates = $this->getFxData($request->query('from'), $request->query('to'));

        return response()->json([
            'component' => "Xrate/Index",
            'props' => ['conversion' => $rates],
            'url' => $request->query('url'),
            ], 200, [
                'Vary' => 'Accept',
                'X-Inertia' => true,
            ]);
    }

    private function getFxData (string $from = 'GBP', string $to = 'EUR') : Array
    {
        /* Exchange Rate API */
        $response = Http::get("https://v6.exchangerate-api.com/v6/" . env('EXCHANGE_RATE_KEY') . "/pair/{$from}/{$to}");

        if ($response->failed()) return response()->json(['error' => 'Unable to retrieve exchange rate data.']);

        $xrate = $response->json();

        return [
            'base_code' => $xrate['base_code'],
            'target_code' => $xrate['target_code'],
            'rate' => $xrate['conversion_rate']
        ];
    }
}
