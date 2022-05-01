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

    .dtable-container {
        max-width: 100% !important;
    }

    .dtable-container table {
        table {
            white-space: nowrap !important;
            width:100%!important;
            border-collapse:collapse!important;
        }
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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / Activity Logs
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="dtable-container">
                            <table class="table table table-hover table-sm css-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID - Model</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Old Values</th>
                                        <th scope="col">New Values</th>
                                    </tr>
                                </thead>
                                <tbody id="audits">
                                    @if (count($audits) > 0)
                                        @foreach($audits as $audit)
                                          <tr>
                                            <td>{{ $audit->auditable_id }} - {{str_replace("App\\","",$audit->auditable_type)}}</td>
                                            <td>{{ $audit->event }}</td>
                                            <td>{{ $audit->user->name }}</td>
                                            <td>{{ date('m/d/Y H:i:s A', strtotime($audit->created_at)) }}</td>
                                            <td>
                                              <table class="table table-sm table-bordered">
                                                @foreach($audit->old_values as $attribute => $value)
                                                  <tr>
                                                    <td><b>{{ $attribute }}</b></td>
                                                    <td>{{ $value }}</td>
                                                  </tr>
                                                @endforeach
                                              </table>
                                            </td>
                                            <td>
                                              <table class="table table-sm table-bordered">
                                                @foreach($audit->new_values as $attribute => $value)
                                                  <tr>
                                                    <td><b>{{ $attribute }}</b></td>
                                                    <td>{{ $value }}</td>
                                                  </tr>
                                                @endforeach
                                              </table>
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
    </div>


    <div class="modal" id="delete_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
               <!--  <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->

                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete_item">Delete</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.css-table').dataTable({
            'order': [[3, 'asc']],
        })
    })
</script>
@endsection
