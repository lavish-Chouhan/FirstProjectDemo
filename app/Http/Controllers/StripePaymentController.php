<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Invoice;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     $stripe->refunds->create([
    //     'charge' => 'ch_3JmuToSHRkMY5clT0McrgMNb',
    //   ]);.

    return view('user.stripe',['id' => $id]);
}

/**
 * success response method.
 *
 * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $amt = Invoice::Where('id',$request->id)->get(['total']);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
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
        $payment->invoices_id = $request->id;

        $payment->save();



       Session::flash('success', 'Payment successful!');

        return back();
    }


    public function test(){
        $invoice = Payment::find(3)->payment;
    }
}
