@extends('layouts.master')

@section('content')
<style>
    button.sso {
  width: 100px;
  height: 50px;
  background: green;
  transition: width 2s;
}
    button.sso:hover {
        width: 200px;
    }
</style>
<div class="card">
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="row mx-md-n5">
            <div class="col px-md-5"><div class="p-3 border bg-light">
        <label>Stripe Key</label>
        <input type="text" name="stripe_key" id="stripe_key" placeholder="Enter Stripe Key">
            </div>
        </div>
        <br>
        <div class="col px-md-5"><div class="p-3 border bg-light">
        <label>Stripe Secret</label>
        <input type="text" name="stripe_secret" id="stripe_secret" placeholder="Enter Secret key">
        </div>
        </div>
        <br>

    </div>
    <div class="center">
        <button type="submit" class="sso" >Submit </button>
    </div>
    </form>
</div>
@endsection
