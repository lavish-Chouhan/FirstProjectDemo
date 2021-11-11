<?php

namespace App\Traits;

use App\Mail\DynamicEmail;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

trait envTrait {

    public function setSMTP()
    {
        if(isset(Auth::user()->id)) {
            $configuration = EmailConfiguration::where("user_id", Auth::user()->id)->first();
            if(!is_null($configuration)) {
                Config::set('mail.default', $configuration->driver);
                Config::set('mail.mailers.smtp.host', $configuration->host);
                Config::set('mail.mailers.smtp.port', $configuration->port);
                Config::set('mail.mailers.smtp.encryption', $configuration->encryption);
                Config::set('mail.mailers.smtp.username', $configuration->user_name);
                Config::set('mail.mailers.smtp.password', $configuration->password);
                Config::set('mail.from.name', $configuration->sender_name);
                Config::set('mail.from.address', $configuration->sender_email);
            }
        }
    }
}

