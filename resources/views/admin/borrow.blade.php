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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / Borrow Items
                </div>
                <div class="card-body">
                  <div class="row">
                        <div class="col-md-3">
                            <!-- <div class="form-group">
                                <select class="form-control" id="filter_status">
                                    <option disabled selected>Filter by Category</option>
                                    <option value="CSS">CSS</option>
                                    <option value="EPAS">EPAS</option>
                                </select>
                            </div>   -->  

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
                        <div class="alert alert-danger" role="alert"></div>
                        <div class="alert alert-success" role="alert"></div>
                        <div class="tab-content" id="myTabContent">
                            <div class="alert alert-info" role="alert"></div>
                            <div class="tab-pane fade show active" id="css" role="tabpanel" aria-labelledby="css-tab">
                                <table class="table table table-hover table-sm css-borrow-table">
                                    <thead>
                                        <tr>
                                          <th scope="col">Borrower</th>
                                          <th scope="col">Item</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Type</th>
                                          <th scope="col">Expiration</th>
                                          <th scope="col">Created</th>
                                          <th scope="col">Updated</th>
                                          <th scope="col">Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($css_borrow) > 0)
                                            @foreach ($css_borrow as $c_borrow)
                                            <tr>
                                                <td>{{ $c_borrow['borrower_name'] }}</td>
                                                <td>{{ $c_borrow['item_name'] }}</td>
                                                <td>{{ $c_borrow['quantity'] }}</td>
                                                <td>{{ $c_borrow['type'] }}</td>
                                                <td>{{ $c_borrow['expired_at'] == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($c_borrow['expired_at'])) }}</td>
                                                <td>{{ $c_borrow['created_at'] }}</td>
                                                <td>{{ $c_borrow['updated_at'] }}</td>
                                                <td>{{ $c_borrow['status'] }}</td>
                                                <td class="text-center">

                                                    @if ($c_borrow['is_returned'] == "No")
                                                       @if ($c_borrow['status'] == "Pending")
                                                            <button class="change_status btn btn-sm btn-outline-success" 
                                                                data-id="{{$c_borrow['borrow_id']}}" 
                                                                data-quantity="{{$c_borrow['quantity']}}"
                                                                data-category="CSS"
                                                                data-status="2"
                                                                >
                                                                    <i class="far fa-check-circle"></i>
                                                            </button>

                                                            <button class="change_status btn btn-sm btn-outline-danger" 
                                                                data-id="{{$c_borrow['borrow_id']}}" 
                                                                data-quantity="{{$c_borrow['quantity']}}"
                                                                data-category="CSS"
                                                                data-status="3" 
                                                                >
                                                                    <i class="far fa-times-circle"></i>
                                                            </button>
                                                        @elseif ($c_borrow['status'] == "Approved")
                                                            <button class="change_status btn btn-sm btn-outline-info" 
                                                                data-id="{{$c_borrow['borrow_id']}}" 
                                                                data-quantity="{{$c_borrow['quantity']}}"
                                                                data-category="CSS"
                                                                data-status="4" 
                                                                >
                                                                    <i class="fas fa-undo-alt"></i>
                                                            </button>
                                                        @else
                                                            <p class="text-center">--</p> 
                                                       @endif
                                                    @else 
                                                        <p class="text-center">--</p>
                                                    @endif
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

                            <div class="tab-pane fade" id="epas" role="tabpanel" aria-labelledby="epas-tab">
                                <table class="table table table-hover table-sm epas-borrow-table">
                                    <thead>
                                        <tr>
                                          <th scope="col">Borrower</th>
                                          <th scope="col">Item</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Type</th>
                                          <th scope="col">Expiration</th>
                                          <th scope="col">Created</th>
                                          <th scope="col">Updated</th>
                                          <th scope="col">Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($epas_borrow) > 0)
                                            @foreach ($epas_borrow as $e_borrow)
                                            <tr>
                                                <td>{{ $e_borrow['borrower_name'] }}</td>
                                                <td>{{ $e_borrow['item_name'] }}</td>
                                                <td>{{ $e_borrow['quantity'] }}</td>
                                                <td>{{ $e_borrow['type'] }}</td>
                                                <td>{{ $e_borrow['expired_at'] == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($e_borrow['expired_at'])) }}</td>
                                                <td>{{ $e_borrow['created_at'] }}</td>
                                                <td>{{ $e_borrow['updated_at'] }}</td>
                                                <td>{{ $e_borrow['status'] }}</td>
                                                <td class="text-center">
                                                    @if ($e_borrow['is_returned'] == "No")
                                                       @if ($e_borrow['status'] == "Pending")
                                                            <button class="change_status btn btn-sm btn-outline-success" 
                                                                data-id="{{$e_borrow['borrow_id']}}" 
                                                                data-quantity="{{$e_borrow['quantity']}}"
                                                                data-category="EPAS"
                                                                data-status="2"
                                                                >
                                                                    <i class="far fa-check-circle"></i>
                                                            </button>

                                                            <button class="change_status btn btn-sm btn-outline-danger" 
                                                                data-id="{{$e_borrow['borrow_id']}}" 
                                                                data-quantity="{{$e_borrow['quantity']}}"
                                                                data-category="EPAS"
                                                                data-status="3" 
                                                                >
                                                                    <i class="far fa-times-circle"></i>
                                                            </button>
                                                        @elseif ($e_borrow['status'] == "Approved")
                                                            <button class="change_status btn btn-sm btn-outline-info" 
                                                                data-id="{{$e_borrow['borrow_id']}}" 
                                                                data-quantity="{{$e_borrow['quantity']}}"
                                                                data-category="EPAS"
                                                                data-status="4" 
                                                                >
                                                                    <i class="fas fa-undo-alt"></i>
                                                            </button>
                                                        @else
                                                            <p class="text-center">--</p> 
                                                       @endif
                                                    @else 
                                                        <p class="text-center">--</p>
                                                    @endif
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
    </div>


    <div class="modal" id="delete_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
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
        var id = ""
        $('.alert').hide()

        $('.css-borrow-table').dataTable({
            'order': [[7, 'asc']],
        })

        $('.epas-borrow-table').dataTable({
            'order': [[7, 'asc']],
        })
    })

    // $('a[data-toggle="tab"]').on('click', function (e) {
    //     localStorage.setItem('activeTab', $(this).attr('href'))
    // })

    // var activeTab = localStorage.getItem('activeTab');
    // if(activeTab){
    //     $('a[data-toggle="tab"]').removeClass('active')
    //     $('.nav-tabs a[href="' + activeTab + '"]').addClass("active")

    //     $('.tab-pane').removeClass('active')
    //     $('.tab-pane'+activeTab).addClass("active")
    // }

    $(document).on('click','.change_status', function() {
    
        if ($(this).attr('data-category') == "CSS") {
            var url = "{{url('admin/borrow')}}/"+$(this).attr('data-id')
        } else {
            var url = "{{url('admin/borrow')}}/"+$(this).attr('data-id')
        }

        var data = {
            id: $(this).attr('data-id'),
            quantity: $(this).attr('data-quantity'),
            category: $(this).attr('data-category'),
            status: $(this).attr('data-status')
        }

        axios.put(url, data)
        .then(function (response) {
            if (response.data.code == 422) {
                    $('.alert-success').css('display','none')
                    $('.alert-danger').css('display','block')
                    var html = ""
                    $.each(response.data.error, function(x,y) {
                        html += '<p>&bullet; '+y+' </p>'
                    })

                    $('.alert-danger').html(html)
            } else {
                $('.alert-success').css('display','block')
                $('.alert-success').html('<p>&bullet; '+response.data.success+' </p>')
                $('.alert-danger').css('display','none')
                setTimeout(function() {
                    window.location.href = "{{url('admin/borrow')}}"
                },100)

            }
        })
        .catch(function (error) {
        })
    })
   
</script>
@endsection
