@extends('layouts.master')

@section('content')
<h1>Create a New Invoice</h1>

<form action="/invoice/create" method="POST" >
    {{csrf_field()}}

    <div class="form-group">
        <label for="name">Name of Invioce</label>
        <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="text" class="form-control" name="total" placeholder="total">
    </div>
    <button name="submit" type="submit">Submit</button>
</form>
@endsection
