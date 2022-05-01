@extends('layouts.app')
@include('layouts.admin_sidebar')

@section('content')
<style>
    .card-text {
        font-size: 13px;
    }

    .alert-danger > p {
        margin-bottom:0px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @yield('sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / Users
                </div>
                <div class="card-body">
                  <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{url('admin/users/create')}}" class="btn btn-primary" id="add_user">Add New User</a>
                            <!-- <div class="form-group">
                                <select class="form-control" id="filter_category">
                                    <option disabled selected>Filter category</option>
                                    <option value="">All</option>
                                    <option value="css">CSS</option>
                                    <option value="epas">EPAS</option>
                                </select>
                            </div> -->
                        </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-info" role="alert"></div>
                          <table class="table table table-hover table-sm user-table">
                                <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <!-- <th scope="col">Category</th> -->
                                      <th scope="col">Date Created</th>
                                      <th scope="col">Date Updated</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <!-- <td> -->
                                                @if ($user->is_css == 1)
                                                    <!-- <span>CSS</span> -->
                                                @elseif ($user->is_epas == 1)
                                                    <!-- <span>EPAS</span> -->
                                                @endif
                                            <!-- </td> -->
                                            <td>{{ date("M d, Y H:i:s a", strtotime($user->created_at)) }}</td>
                                            <td>{{ date("M d, Y H:i:s a", strtotime($user->updated_at)) }}</td>
                                            <td>
                                              <a href="{{url('admin/users/')}}/{{$user->id}}/edit" class="btn btn-sm btn-outline-primary">
                                                  <i class="far fa-edit"></i>
                                              </a>
                                              <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger show_delete_modal" data-id="{{$user->id}}" data-toggle="modal" data-target="#delete_modal">
                                                  <i class="fas fa-trash-alt"></i>
                                              </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No records found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                      </div>
                  </div>    
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="delete_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete_user">Delete</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var id = ""
        $('.alert').hide()
    })

    var table = $('.user-table').dataTable({
        'order': [[3, 'desc']]
    })

    $(document).on('click', '.show_delete_modal', function() {
        id = $(this).attr('data-id')
    })

    $(document).on('click', '#delete_user', function() {
        var url = "{{url('admin/users')}}/"+id
        var data = {
            _token: "{{ csrf_token() }}",
        }

        axios.delete(url, data)
        .then(function (response) {
            $('#delete_modal').modal('hide')
            $('.alert-info').css('display','block')
            $('.alert-info').html('<p>&bullet; '+response.data.message+' </p>')

            setTimeout(function() {
                $('.alert-info').css('display','none')
                window.location.href = "{{url('admin/users')}}"
            }, 2000)

        })
        .catch(function (error) {
        });
    })
   
</script>
@endsection
