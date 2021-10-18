@extends('layouts.master')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <title>Users Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  </head>
  <body>
    @role('admin')
    <a class="btn btn-light" href="{{ url('export-excel') }}">Export Excel</a>
    <a class="btn btn-light" href="{{ url('export-csv') }}">Export CSV</a>
    <a class="btn btn-light printPage" href="#">Print</a>
        <form method="POST" enctype="multipart/form-data" action="{{ route('user.import') }}" >
            @csrf
            <input type="file" name="file">
            <input id="submitbtn" class="btn btn-success btn-sm" name="Submit" type="submit" value="Import" />
            {{-- <button class="btn btn-success btn-sm" type="submit">Import</button> --}}
        </form>
        <a href="{{ url('users/hi') }}" value="hi" >Change Language to Hindi</a>
  <div class="container mt-5">

    <h3 class="text-center font-weight-bold">{{ __('profile.welcome') }}</h3>

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
         <form id="createUser" name="createUser" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">

            <lable>Name</lable>
            <input type="text" id="name" name="name" class="form-control">
            <lable>Email</lable>
            <input type="text" id="email" name="email" class="form-control">
            <lable>Password</lable>
            <input type="text" id="password" name="password" class="form-control">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit"  class="btn btn-primary">Save changes</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <!-- Edit Modal -->

<!-- Edit Product Modal -->
<div class="modal" id="EditProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Edit</h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Product was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditProductModalBody">

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditProductForm">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- View modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showModalLabel">Show User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="form_result"></span>
        <div class="modal-body">
            <lable>user</lable>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit"  class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>
{{-- end of view model --}}



    <table class="table mt-4" id="usersTable">
        <thead>
            <th> # </th>
            <th> Name </th>
            <th> Email </th>
            <th> role </th>
            <th> Action </th>

        </thead>


        <tbody>
        </tbody>
    </table>
  </div>
  @else
  You are not admin
@endrole

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                // processing: true,
                serverSide: true,
                ajax: "{{ route('user_data') }}",
                method:'GET',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action'}
                ],

            });
        $('.show').on("submit", function (){
            console.log('hello');
        })

        $('#createUser').on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('store_data') }}",
                method:'POST',
                data:$(this).serialize() ,
                dataType:"json",
                success: function (data) {
                    location.reload();
                    // window.location.href="{{ route('store_data') }}";

                },
            });
        })
    });

            $('.modelClose').on('click', function(){
            $('#EditProductModal').hide();
            });
        var id;
        $('body').on('click', '#getEditProductData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();

            id = $(this).data('id');

            $.ajax({
                url: "users/edit/"+id,
                method: 'GET',
                success: function(result) {
                        $('#EditProductModalBody').html(result.html);
                        $('#EditProductModal').show();
                    }
                });

        });

        $('a.printPage').click(function(){
            window.print();
            return false;
        });

    </script>

</body>
</html>


@endsection


