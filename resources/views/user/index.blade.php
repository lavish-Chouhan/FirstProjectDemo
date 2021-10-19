@extends('layouts.master')

@section('content')

   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
    Create New User
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <span id="form_result"></span>
     <form id="createInvoice" name="createInvoice" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">

        <lable>Name</lable>
        <input type="text" id="name" name="name" class="form-control">
        <lable>Total Amount</lable>
        <input type="text" id="total" name="total" class="form-control">

    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" name="submit"  class="btn btn-primary">Save changes</button>
    </div>
  </div>
  </form>
</div>
</div>

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
            <td><a href="{{ route('invoice.show',$invoice->id) }}" class="btn btn-primary">Show</a></td>
            <td><a href="{{ url('stripe') }}" class="btn btn-success">Pay Now</a></td>
        </tr>
        @empty
        <tr>
            <td>No invoice</td>
        </tr>
        @endforelse
</table>
@endsection
