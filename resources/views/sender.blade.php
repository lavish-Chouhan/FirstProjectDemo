@extends('layouts.master')

@section('content')
<div class="container">
<form action="/sender" method="POST">
    <input type="text" class="form-field" name="text" placeholder="Enter Data ">
    <input type="submit" class="btn btn-primary">
    {{ csrf_field() }}
</form>
</div>

@endsection
