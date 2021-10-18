@extends('layouts.master')

@section('content')
<div class="container text-center">
    <h1>Details of your invoice</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>{{ $Invoice->id }}</td>
            <td>{{ $Invoice->name }}</td>
            <td>{{ $Invoice->total }}</td>
            <td><a href="{{ url('stripe') }}" class="btn btn-success">Pay</a></td>
        </tr>

    </table>


</div>

@endsection
