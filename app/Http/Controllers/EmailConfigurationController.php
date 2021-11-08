<?php

namespace App\Http\Controllers;

use App\Mail\DynamicEmail;
use Illuminate\Http\Request;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailConfigurationController extends Controller
{
    public function createConfiguration(Request $request) {

        $configuration  =   EmailConfiguration::create([
            "user_id"       =>      Auth::user()->id,
            "driver"        =>      $request->driver,
            "host"          =>      $request->hostName,
            "port"          =>      $request->port,
            "encryption"    =>      $request->encryption,
            "user_name"     =>      $request->userName,
            "password"      =>      $request->password,
            "sender_name"   =>      $request->senderName,
            "sender_email"  =>      $request->senderEmail
        ]);

        if(!is_null($configuration)) {
           return back()->with("success", "Email configuration created.");
        }

        else {
            return back()->with("failed", "Email configuration not created.");
        }
    }

    public function sendEmail(Request $request) {

        $toEmail    =   $request->emailAddress;
        $data       =   array(
            "message"    =>   $request->message
        );

        // pass dynamic message to mail class
        Mail::to($toEmail)->send(new DynamicEmail($data));

        if(Mail::failures() != 0)
        {
            return back()->with("success", "E-mail sent successfully!");
        }

        else
        {
            return back()->with("failed", "E-mail not sent!");
        }
    }

    public function composeEmail() {
        return view("configuration.email");
    }
}
