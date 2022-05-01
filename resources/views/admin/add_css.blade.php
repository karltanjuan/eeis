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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / <a href="{{url('/admin/css')}}">CSS Inventory</a> / Add Item
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert"></div>
                            <div class="alert alert-success" role="alert"></div>
                        </div>      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="item_name">Name</label>
                                <input type="text" class="form-control" id="item_name" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="item_quantity">Quantity</label>
                                <input type="number" class="form-control" id="item_quantity" placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="expired_at">Expiration</label>
                                <input type="date" class="form-control" id="expired_at">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="item_type">Type</label>
                                <select class="form-control" id="item_type">
                                    <option value="" disabled selected>Select type</option>
                                    <option value="Type 1">Type 1</option>
                                    <option value="Type 2">Type 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="item_status">Status</label>
                                <select class="form-control" id="item_status">
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Brand New">Brand New</option>
                                    <option value="Good">Good</option>
                                    <option value="Defective">Defective</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right" id="add_item">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.alert').hide();
    })

    $(document).on('click','#add_item', function() {
        var url = "{{url('admin/css')}}"
        var data = {
            _token: "{{ csrf_token() }}",
            item_name: $('#item_name').val(),
            item_quantity: $('#item_quantity').val(),
            expired_at: $('#expired_at').val(),
            item_type: $('#item_type option:selected').val(),
            item_status: $('#item_status option:selected').val()
        }

        axios.post(url, data)
        .then(function (response) {
            if (response.data.code == 422) {
                    $('.alert-success').css('display','none')
                    $('.alert-danger').css('display','block')
                    var html = "";
                    $.each(response.data.error, function(x,y) {
                        html += '<p>&bullet; '+y+' </p>'
                    })

                    $('.alert-danger').html(html)
            } else {
                $('.alert-success').css('display','block')
                $('.alert-success').html('<p>&bullet; '+response.data.success+' </p>')
                $('.alert-danger').css('display','none')
                setTimeout(function() {
                    window.location.href = "{{url('admin/css')}}"
                },100)

            }
        })
        .catch(function (error) {
        });
    })
</script>
@endsection
