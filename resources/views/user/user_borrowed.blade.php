@extends('layouts.app')
@include('layouts.user_sidebar')

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
                    <a href="{{url('/user')}}">User Dashboard</a> / Borrowed Items
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-tabs mb-3" id="table-tab" role="tablist">
                                <li class="nav-item">
                                      <a class="nav-link active" id="css-tab" data-toggle="tab" href="#css" role="tab" aria-controls="css" aria-selected="true">CSS</a>
                                </li>
                                <li class="nav-item">
                                      <a class="nav-link" id="epas-tab" data-toggle="tab" href="#epas" role="tab" aria-controls="epas" aria-selected="false">EPAS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="alert alert-info" role="alert"></div>
                        <div class="tab-content" id="tab_content">
                            <div class="tab-pane fade show active" id="css" role="tabpanel" aria-labelledby="css-tab">
                                <table class="table table table-hover table-sm css-borrowed-table">
                                  <thead>
                                      <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Expiration</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if (count($css_borrowed_items) > 0)
                                            @foreach ($css_borrowed_items as $c_borrow)
                                              @if ($c_borrow['status'] != "Returned")
                                                <tr>
                                                  <td>{{ $c_borrow['item_name'] }}</td>
                                                  <td>{{ $c_borrow['quantity'] }}</td>
                                                  <td>{{ $c_borrow['type'] }}</td>
                                                  <td>{{ $c_borrow['expired_at'] == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($c_borrow['expired_at'])) }}</td>
                                                  <td>{{ $c_borrow['created_at'] }}</td>
                                                  <td>{{ $c_borrow['updated_at'] }}</td>
                                                  <td>{{ $c_borrow['status'] }}</td>
                                                </tr>
                                              @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">No records found.</td>
                                            </tr>
                                        @endif
                                  </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="epas" role="tabpanel" aria-labelledby="epas-tab">
                                <table class="table table table-hover table-sm epas-borrowed-table">
                                  <thead>
                                      <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Expiration</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                        @if (count($epas_borrowed_items) > 0)
                                            @foreach ($epas_borrowed_items as $e_borrow)
                                              @if ($e_borrow['status'] != "Returned")
                                                <tr>
                                                  <td>{{ $e_borrow['item_name'] }}</td>
                                                  <td>{{ $e_borrow['quantity'] }}</td>
                                                  <td>{{ $e_borrow['type'] }}</td>
                                                  <td>{{ $e_borrow['expired_at'] == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($e_borrow['expired_at'])) }}</td>
                                                  <td>{{ $e_borrow['created_at'] }}</td>
                                                  <td>{{ $e_borrow['updated_at'] }}</td>
                                                  <td>{{ $e_borrow['status'] }}</td>
                                                </tr>
                                              @endif
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
    </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var id = ""
        $('.alert').hide()

        $('.css-borrowed-table').dataTable({
          'order': [[5, 'desc']]
        })

        $('.epas-borrowed-table').dataTable({
          'order': [[5, 'desc']]
        })
    })

   
</script>
@endsection
