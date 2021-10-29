@extends('layouts.master')

@section('content')
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <a href="{{ route('email') }}" :active="request()->routeIs('email')">
        {{ __('Send Email') }}
    </a>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">

                <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-md w-full space-y-8">

                        @if(Session::has("success"))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{Session::get('success')}}</span>
                            </div>

                        @elseif(Session::has("failed"))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Failed!</strong>
                                <span class="block sm:inline">{{Session::get('failed')}}</span>
                            </div>
                        @endif

                        <div>
                            <h2 class="text-center text-3xl font-extrabold text-gray-900">Create Email Configuration</h2>
                        </div>

                        <form action="{{route('configuration.store')}}" method="POST">
                            @csrf
                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="driver" class="sr-only">SMTP Driver</label>
                                        <input id="driver" name="driver" type="text" required class="form-group" placeholder="Driver">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="host-name" class="sr-only">Host Name</label>
                                        <input id="host-name" name="hostName" type="text" required class="form-group" placeholder="Host">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="port" class="sr-only">Port</label>
                                        <input id="port" name="port" type="text" required class="form-group" placeholder="Port">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="userName" class="sr-only">User Name</label>
                                        <input id="userName" name="userName" type="text" required class="form-group" placeholder="User Name">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="password" class="sr-only">Password</label>
                                        <input id="password" name="password" type="password" autocomplete="current-password" required class="form-group" placeholder="Password">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="senderName" class="sr-only">Sender Name</label>
                                        <input id="senderName" name="senderName" type="text" required class="form-group" placeholder="Sender Name">
                                    </div>
                                </div>

                                <div class="shadow-sm -space-y-px mb-4">
                                    <div>
                                        <label for="senderEmail" class="sr-only">Sender Email</label>
                                        <input id="senderEmail" name="senderEmail" type="text" required class="form-group" placeholder="Sender Email">
                                    </div>
                                </div>
                            <div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
