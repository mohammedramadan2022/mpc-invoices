<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Quote;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function getLastInvoiceId(Request $request)
    {


        $clientId = $request->input('client_id');


        $client = Client::whereHas('user', function ($query) use ($clientId) {

            $query->where('users.id', $clientId);
        })->first();


        $lastInvoice = Invoice::where('client_id', $client->id)->latest('invoice_id')->first();



        return response()->json([
            'last_invoice_id' => $lastInvoice ? self::getLastIvoicePlus1($lastInvoice->invoice_id) : ($client ? $client->invoice_start : 1),
        ]);
    }

    public static function getLastIvoicePlus1($invoiceNumber)
    {
        preg_match('/(\d+)$/', $invoiceNumber, $matches);

        if (isset($matches[1])) {
            // Extract the numeric part
            $number = intval($matches[1]);

            // Increment the number
            $incrementedNumber = $number + 1;

            // Replace the old number with the new incremented number
            return $incrementedNumber;
        }

        return $invoiceNumber +1;
    }

    public function getLastQuoteId(Request $request)
    {


        $clientId = $request->input('client_id');


        $client = Client::whereHas('user', function ($query) use ($clientId) {

            $query->where('users.id', $clientId);
        })->first();
        $lastQuote = Quote::where('client_id', $client->id)->latest('quote_id')->first();
        return response()->json([
            'last_quote_id' => $lastQuote ? $lastQuote->quote_id + 1 : ($client ? $client->quote_start : 1),
        ]);
    }
}
