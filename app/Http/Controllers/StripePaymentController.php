<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\StripeConfig;

class StripePaymentController extends Controller
{
    public $testkey,$testsecret;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
        $testkey = StripeConfig::first()->stripe_key;
        return view('user.stripe',['id' => $id, 'testkey' => $testkey]);
    }

/**
 * success response method.
 *
 * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $amt = Invoice::Where('id',$request->id)->get(['total']);
        $testsecret = StripeConfig::first()->stripe_secret;

        Stripe\Stripe::setApiKey($testsecret);
        $data = Stripe\Charge::create ([
            "amount" => $amt[0]['total']*100,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Test payment."
        ]);

        $payment = new payment;
        $payment->transaction_id = $data->id;
        $payment->amount = $data->amount;
        $payment->status = $data->status;
        $payment->invoice_id = $request->id;

        $payment->save();



       Session::flash('success', 'Payment successful!');

        return back();
    }

    public function refund($id){
        $ref = Payment::Where('invoice_id',$id)->first();
        $testkey = StripeConfig::first()->stripe_secret;

        $stripe = new \Stripe\StripeClient($testkey);
        $response= $stripe->refunds->create([
            'charge' => $ref->transaction_id,
        ]);

        if ($response->status){
            $ref->status = 'refunded';
            $ref->save();
        }
        return redirect()->route('invoice_table')->withMessage('Updated');

    }

}
