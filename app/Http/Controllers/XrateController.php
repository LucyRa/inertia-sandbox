<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Inertia\Inertia;

class XrateController extends Controller
{
    public function index ()
    {
        return Inertia::render('Xrate/Index');
    }

    public function result (Request $request)
    {
        $rates = $request->session()->get('rates');

        // if (!$rates) ... TBC

        return Inertia::render('Xrate/Result', [
            'data' => json_decode($rates, true)
        ]);
    }

    public function rates (Request $request)
    {
        // Unvalidated, unsecure... TESTING
        $rates = $this->getFxData($request->input('from'), $request->input('to'));

        $request->session()->flash('rates', $rates);

        return to_route('xrate.result');
    }

    private function getFxData (string $from = 'GBP', string $to = 'EUR') : String
    {
        /* Alpha Vantage API */
        // $json = file_get_contents('https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=' . $from . '&to_currency=' . $to . '&apikey=' . env('ALPHA_VANTAGE_KEY'));

        /* Exchange Rate API */
        $response = Http::get("https://v6.exchangerate-api.com/v6/" . env('EXCHANGE_RATE_KEY') . "/pair/{$from}/{$to}");

        if ($response->failed()) return [];

        $data = json_encode([
            'base_code' => $response['base_code'],
            'target_code' => $response['target_code'],
            'rate' => $response['conversion_rate']
        ]);

        return $data;
    }
}
