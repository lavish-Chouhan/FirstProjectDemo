<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        // $description= 'apple';
        $description = Role::first()->name;
        return view('demo', compact('description'));
    }
}
