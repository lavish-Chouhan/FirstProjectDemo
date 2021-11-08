<?php

namespace App\Http\Controllers;
use App\Traits\envTrait;

use Illuminate\Http\Request;

class EnvSettingController extends Controller
{
    use envTrait;

    public function __construct(){
        $this->emailSet();
    }
}
