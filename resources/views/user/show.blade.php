@extends('layouts.master')

@section('content')
<div class="container text-center">
    <h1>Details of your invoice</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>status</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->total }}</td>
            {{-- <td class="text-success">{{ $invoice->payment->status}}</td> --}}
            {{-- <td><a href="{{ url('stripe/'.$invoice->id) }}" class="btn btn-success">Pay Now</a></td> --}}
            <td><div id="paypal-button-container"></div></td>
            @role('admin')
            @if($invoice->payment)
            <td><a class="btn btn-info" href="{{ url('stripe/refund/'.$invoice->id) }}">Refund</a></td>
            @endif
            @endrole
        </tr>

    </table>


</div>
<script
src="https://www.paypal.com/sdk/js?client-id=AYGJZcRKHdm0H5LecbE9lAy3ZiscFeQGk717b98iYIXTybfSd-0Ximz7tZPYlBl4OLh2tDNdTO5HaSLe">
</script>
<script>
paypal.Buttons({
createOrder: function(data, actions) {
// This function sets up the details of the transaction, including the amount and line item details.
return actions.order.create({
  purchase_units: [{
    amount: {
      value: '{{$invoice->total}}'
    }
  }]
});
},
onApprove: function(data, actions) {
return actions.order.capture().then(function(details) {
  alert('Transaction completed by ' + details.payer.name.given_name);
});
}
}).render('#paypal-button-container');
//This displays Smart Payment Buttons on web page.
</script>
@endsection
