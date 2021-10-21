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
            <td>{{ $Invoice->id }}</td>
            <td>{{ $Invoice->name }}</td>
            <td>{{ $Invoice->total }}</td>
            {{-- <td>{{ $->status }}</td> --}}
            <td><a href="{{ url('stripe/'.$Invoice->id) }}" class="btn btn-success">Pay Now</a></td>
            <td><div id="paypal-button-container"></div></td>

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
      value: '{{$Invoice->total}}'
    }
  }]
});
},
onApprove: function(data, actions) {
// This function captures the funds from the transaction.
return actions.order.capture().then(function(details) {
  // This function shows a transaction success message to your buyer.
  alert('Transaction completed by ' + details.payer.name.given_name);
});
}
}).render('#paypal-button-container');
//This function displays Smart Payment Buttons on your web page.
</script>
@endsection
