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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / CSS Inventory
                </div>
                <div class="card-body">
                  <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{url('admin/css/create')}}" class="btn btn-primary" id="add_item">Add New Item</a>
                        </div>
                        <div class="col-md-9">
                            <span class="float-right">
                                <b>Computer System Servicing</b>
                            </span>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="input-group mb-3">
                              <input type="text" id="input_search" class="form-control" placeholder="Search items">
                              <div class="input-group-append">
                                <button class="btn btn-outline-primary" id="btn_search" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                              </div>
                            </div>
                        </div> -->
                       <!--  <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="filter_type">
                                    <option disabled selected>Filter by Type</option>
                                    <option value="Type 1">Type 1</option>
                                    <option value="Type 2">Type 2</option>
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="filter_status">
                                    <option disabled selected>Filter by Status</option>
                                    <option value="Brand New">Brand New</option>
                                    <option value="Good">Good</option>
                                    <option value="Defective">Defective</option>
                                </select>
                            </div>    
                        </div> -->
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="alert alert-info" role="alert"></div>
                          <table class="table table table-hover table-sm css-table">
                                <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Date Listed</th>
                                      <th scope="col">Expiration</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($items) > 0)
                                        @foreach ($items as $item)
                                            @if ($item->item_quantity > 0)
                                            <tr>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->item_quantity }}</td>
                                                <td>{{ $item->item_type }}</td>
                                                <td>{{ $item->item_status }}</td>
                                                <td>{{ date_format($item->created_at,"M d, Y") }}</td>
                                                <td>{{ $item->expired_at == '0000-00-00 00:00:00' ? 'N/A' : date('M d, Y', strtotime($item->expired_at)) }}</td>
                                                <td>
                                                  <a href="{{url('admin/css/')}}/{{$item->id}}/edit" class="btn btn-sm btn-outline-primary">
                                                      <i class="far fa-edit"></i>
                                                  </a>
                                                  <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger show_delete_modal" data-id="{{$item->id}}" data-toggle="modal" data-target="#delete_modal">
                                                      <i class="fas fa-trash-alt"></i>
                                                  </a>
                                                </td>
                                              @endif
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
        var id = ""

        $('.alert').hide()
        $('.css-table').dataTable({
            'order': [[5, 'asc']]
        })
    })


    $(document).on('click', '.show_delete_modal', function() {
        id = $(this).attr('data-id')
    })

    $(document).on('click', '#delete_item', function() {
        var url = "{{url('admin/css')}}/"+id
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
                window.location.href = "{{url('admin/css')}}"
            }, 100)

        })
        .catch(function (error) {
        });
    })

    function get_list() {
        var url = "{{url('admin/css')}}"

        axios.get(url, )
        .then(function (response) {
            var html = ""

            if (response.data.items.length > 0) {
                $.each(response.data.items, function(x,y) {
                    html += "<tr>"
                    html += "<td>"+y.item_name+"</td>"
                    html += "<td>"+y.item_quantity+"</td>"
                    html += "<td>"+y.item_type+"</td>"
                    html += "<td>"+y.item_status+"</td>"
                    html += "<td>"+moment(y.created_at).format('LL')+"</td>"
                    html += "<td>"
                        if (y.expired_at == "0000-00-00 00:00:00") {
                            html += "N/A"
                        } else {
                            moment(y.expired_at).format('LL')
                        }
                    html += "</td>"
                    html += "<td>"
                    html += "<a href='{{url('admin/css/')}}/"+y.id+"/edit' class='btn btn-sm btn-outline-primary'>"
                    html +=     "<i class='far fa-edit'></i>"
                    html += "</a>"
                    html += "<a href='javascript:void(0)' class='btn btn-sm btn-outline-danger show_delete_modal' data-id='"+y.id+"' data-toggle='modal' data-target='#delete_modal'>"
                    html +=     "<i class='fas fa-trash-alt'></i>"
                    html += "</a>"
                    html += "</td>"
                    html += "</tr>"
                })
            } else {
                html += "<tr>"
                html += "<td><td colspan='7' class='text-center'>No records found.</td></td>"
                html += "</tr>"
            }

            $('table tbody').html(html)
            // get_list()
        })
        .catch(function (error) {
        });
    }
   
</script>
@endsection
