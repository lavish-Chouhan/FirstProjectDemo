<?php

namespace App\Http\Controllers;

use App\Models\StripeConfig;
use App\Traits\stripeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeConfigController extends Controller
{

    public function input(){
        return view('configuration.stripedetails');
    }

    public function store(Request $request)
    {
        $stripe = StripeConfig::create([
            'stripe_key'=> $request->input('stripe_key'),
            'stripe_secret' => $request->input('stripe_secret')
        ]);
        if(!is_null($stripe))
        {
            return back()->with("success", "configuration created.");
        }
        else
        {
            return back()->with("failed", "configuration not created.");
        }
    }


}
