<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Billing;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $billing = Billing::where('uuid', $request->billing_code)->first();
        if (! $billing) {
            return $this->error('Billing not found', null, 404);
        }
 
        $url = 'https://api.paystack.co/charge';
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer sk_test_bd9c595fdca363d2a72d4a6c09bf69fe5759a3e2',
        ];

        $payload = [
            'email' => $billing->customer->email,
            'amount' => $billing->amount * 100,
            'mobile_money' => [
                'phone' => $request->mobile_money['phone'],
                'provider' => $request->mobile_money['provider'],
            ],
        ];
        // dd($billing->amount. '  '. $billing->amount*100);

        if (! $billing->is_paid) {
            $response = Http::withHeaders($headers)
                ->post($url, $payload);
        } else {
            return $this->error('Payment already completed');
        }


        $response = $response->object();

        if ($response->status) {

            $payment = $response->data;
            $paymentResponse = $billing->payment()->create([
                'transaction_id' => $payment->reference,
                'amount' => $payment->amount,
                'reciept_number' => $payment->receipt_number,
                'reference' => $payment->reference,
                'paid_at' => $payment->paid_at,
                'channel' => $payment->channel,
                'currency' => $payment->currency,
                'status' => $payment->status,
            ]);

            $billing->is_paid = true;
            $billing->save();
        } else {
            return $this->error($response->message);
        }

        return response()->json($paymentResponse);

        // return $this->success('sd', new PaymentResource($response));
        // {
        //     "email": "isaac.boakyemanu+charge@gmail.com",
        //     "amount": "10",
        //      "currency": "GHS",
        //     "mobile_money": {
        //           "phone" : "0247924225",
        //           "provider" : "mtn"
        //         },
        //     "metadata": {
        //       "custom_fields": [
        //         {
        //           "value": "oxygen",
        //           "display_name": "Donation for",
        //           "variable_name": "donation_for"
        //         }
        //       ]
        //     }
        //   }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
