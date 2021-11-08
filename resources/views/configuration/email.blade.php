@extends('layouts.master')

@section('content')
    <header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Email') }}
        </h2>
    </header>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">

                <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-md w-full space-y-8">

                        @if(Session::has("success"))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{Session::get('success')}}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title></svg>
                                </span>
                            </div>

                        @elseif(Session::has("failed"))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Failed!</strong>
                                <span class="block sm:inline">{{Session::get('failed')}}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title></svg>
                                </span>
                            </div>
                        @endif

                        <div>
                            <h2 class="text-center text-3xl font-extrabold text-gray-900">Send Email </h2>
                        </div>

                        <form class="mt-8 space-y-6" action="{{route('email')}}" method="POST">
                            @csrf
                            <div class="shadow-sm -space-y-px mb-4">
                                <div>
                                    <label for="emailAddress" class="sr-only">Email Address</label>
                                    <input id="emailAddress" name="emailAddress" type="email" required class="form-group" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="shadow-sm -space-y-px mb-4">
                                <div>
                                    <label for="message" class="sr-only">Message</label>
                                    <textarea id="message" name="message" type="text" required class="form-group" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Compose Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
