@extends('layouts.master')

@section('content')
<div class="container mt-2">
<h2 class="text-center">Roles</h2>
<div class="text-right">
<a class="mr-3 mb-2 btn btn-success" href="{{route('role.create')}}">Create Role</a>
</div>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Display Name</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    @forelse($roles as $role)
    <tr>
        <td>{{$role->name}}</td>
        <td>{{$role->display_name}}</td>
        <td>{{$role->description}}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{route('role.edit',$role->id)}}">Edit</a>
            <hr>
            <form action="{{route('role.destroy',$role->id)}}"  method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
            </form>

        </td>
    </tr>
    @empty
    <tr>
        <td>No roles</td>
    </tr>
    @endforelse

</div>
</table>


@endsection
