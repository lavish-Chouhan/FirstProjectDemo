@extends('layouts.master')

@section('content')
@role('admin')
   <!-- Button trigger modal -->
<div class="container">
    <a class="btn btn-primary" href="{{ url('invoice/create') }}">Create new Invoice</a>
</div>
@endrole
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>total</th>
    </tr>
    @forelse($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->name}}</td>
            <td>{{$invoice->total}}</td>
            <td>
@role('admin')
                <form action="{{route('invoice.destroy',$invoice->id)}}"  method="POST">
                   {{csrf_field()}}
                   {{method_field('DELETE')}}
                   <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                 </form>
@endrole
            </td>
            <td><a href="{{ route('invoice.show',$invoice->id) }}" class="btn btn-primary">Check Status</a></td>
            {{-- <td><a href="{{ route('invoice.show',$invoice->id) }}" class="btn btn-primary">PAY</a></td> --}}
            @if(!$invoice->payment)
            <td><a href="{{ url('stripe/'.$invoice->id) }}" class="btn btn-success">Pay Now</a></td>
            @endif
            {{-- <td><a href="{{ url('paypal') }}" class="btn btn-light">Pay Now with PayPal</a></td> --}}

        </tr>
        @empty
        <tr>
            <td>No invoice</td>
        </tr>
        @endforelse
</table>


@endsection

