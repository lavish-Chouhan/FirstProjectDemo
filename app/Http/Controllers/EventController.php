<?php

namespace App\Http\Controllers;

use App\Events\EventDemo;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('eventtest.index');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:eventdemo,email'
        ]);

        event(new EventDemo($request->input('email')));

        return back();
    }
}
