@extends('layouts.master')
@section('content')
<h1>Event Listner demo</h1>
<div class="container">
<form action="subscribe" method="POST">
    @csrf
    <input
        type="text"
        name="email"
        placeholder="Enter your mail"
        class="form-control"
    >
    <button type="submit" class="btn btn-success">Submit</button>

</form>
</div>
@endsection
